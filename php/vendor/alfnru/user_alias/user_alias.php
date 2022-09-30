<?php

class user_alias extends rcube_plugin
{
    private $db;

    function init()
    {
        $rcmail = rcmail::get_instance();
        if ($rcmail->config->get('ua_disable'))
            return;

        $this->load_config();
        $this->add_hook('authenticate', [$this, 'alias2user']);
        $this->register_action('alias2user', [$this, 'alias2user']);
    }

    function alias2user($p, $with_domain_alias = true)
    {
        $rcmail = rcmail::get_instance();
        $query_u = $rcmail->config->get('ua_query_user_alias');
        $query_d = $rcmail->config->get('ua_query_domain_alias');

        if ($p['user'] && !empty($query_u)) {
            $dbh = $this->get_dbh();
            $result = $dbh->query($query_u, $this->db->escape($p['user']));

            if ($result && ($arr = $dbh->fetch_array($result))) {
                $p['user'] = $arr[0];
            } else if ($with_domain_alias && $rcmail->config->get('ua_use_domain_alias') && !empty($query_d)) {
                $user_array = explode('@', $p['user']);
                $result = $dbh->query($query_d, $user_array[1]);
                if ($result && ($arr = $dbh->fetch_array($result))) {
                    $p = $this->alias2user(['user' => $user_array[0].'@'.$arr[0]], false);
                }
            }
        }

        return $p;
    }

    private function get_dbh()
    {
        if (!$this->db) {
            $rcmail = rcmail::get_instance();
            if ($dsn = $rcmail->config->get('ua_dsn')) {
                $this->db = rcube_db::factory($dsn);
                $this->db->set_debug((bool)$rcmail->config->get('sql_debug'));
                $this->db->db_connect('r'); // connect in read mode
            }
            else {
                $this->db = $rcmail->get_dbh();
            }
        }
        return $this->db;
    }
}

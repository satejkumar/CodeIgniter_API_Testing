<?php

class Post extends CI_Model {
    public function get($id)
    {
        $post = $this->db->get_where('posts', ['id' => $id]);
        return ($post) ? $post->row_array() : [];
    }

    public function save($post)
    {
        // Validation missing.
        $this->db->insert('posts', $post);
        return $this->db->insert_id();
    }
}

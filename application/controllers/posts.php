<?php

class Posts extends CI_Controller {
    public function index($id = 0)
    {
        $post_req = $this->input->post();
        $get_req = $this->input->get();
        $this->load->model('post');

        if ($post_req)
        {
            $id = $this->post->save($post_req);
            echo json_encode(['id' => $id]);
            exit;
        }

        $post = $this->post->get($id);
        echo json_encode($post);
    }
}

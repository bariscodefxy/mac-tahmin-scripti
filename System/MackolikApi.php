<?php

class MackolikApi {

    protected $api_url = "";

    public function __construct(string $api_url) {
        $this->api_url = $api_url;
    }

}
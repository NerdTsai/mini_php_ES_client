<?php


class Elasticsearch{

    public $index,$domain,$type;

    public function setDomain($domain){
        $this->domain = $domain;
        return $this;
    }

    public function setIndex($index){
        $this->index = $index;
        return $this;
    }
    public function setType($type){
        $this->type = $type;
        return $this;
    }

    function search($payload){
        $f = $this->execute('_search',$payload);
        return $f;
    }

    private function execute($action,$payload){
        $ch     = curl_init();
        $url    = "http://".$this->domain.'/'.$this->index.'/'.$this->type.'/'.$action; 
	$headers= array('Content-Type:'.'application/json');
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 2);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));

        $result = json_decode(curl_exec($ch),true);
	//print_r($result['hits']['hits']);
	curl_close($ch);

        return $result;
    }

}


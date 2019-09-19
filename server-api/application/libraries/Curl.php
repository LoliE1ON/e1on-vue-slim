<?php

class Curl
{
    public $description;
    
    public function __construct ()
    {
        if (!function_exists('curl_init'))
        {
            throw new \Exception('Library cURL not found');
        }
        
        $this->description = curl_init();
    }
    
    public function setUrl ($url)
    {
        curl_setopt($this->description, CURLOPT_URL, $url);
        return $this;
    }
    
    public function setOption ($option, $value = '')
    {
        if (is_array($option))
        {
            foreach ($option as $opt => $value)
            {
                curl_setopt($this->description, $opt, $value);
            }
        }
        else
        {
            curl_setopt($this->description, $option, $value);
        }
        
        return $this;
    }
    
    public function setUa ($ua)
    {
        curl_setopt($this->description, CURLOPT_USERAGENT, $ua);
        return $this;
    }
    
    public function setCookie ($cookieString)
    {
        curl_setopt($this->description, CURLOPT_COOKIE, $cookieString);
        return $this;
    }

    public function setProxy ()
    {

         $arr = file(R.'TF/proxy.txt');
         $index = array_rand ($arr, 1);

         curl_setopt($this->description, CURLOPT_PROXY, $arr[$index]); 
         return $this;

    }  

    public function getQuery ()
    {
        curl_setopt($this->description, CURLOPT_RETURNTRANSFER, 1);
        return curl_exec($this->description);
    }
    
    public function setPost ($data)
    {
        
        curl_setopt($this->description, CURLOPT_POST, TRUE);
        curl_setopt($this->description, CURLOPT_POSTFIELDS, $data);
        
        return $this;
    }
}
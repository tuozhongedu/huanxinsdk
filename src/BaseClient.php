<?php

/**
 * 环信 client
 */
namespace Jiemo\Huanxin;

use Exception;
use GuzzleHttp\Client as HttpClient;

class BaseClient
{
    protected $client = null;

    private $appName = '';
    private $orgName = '';
    private $clientId = '';
    private $clientSecret = '';

    private $accessToken = null;

    protected $baseUrl = 'https://a1.easemob.com';

    protected $async = false;

    public function __construct($orgName = '', $appName = '')
    {
        $this->appName = $appName;
        $this->orgName = $orgName;

        $this->client = new HttpClient(
            [
                'base_uri' => $this->baseUrl,
                'http_errors' => false,
            ]
        );
    }

    public function getJson($response)
    {
        return json_decode($response->getBody(), true);
    }

    /**
     * 构建请求URL
     *
     * @author Cong Peijun <congpeijun@tuozhongedu.com>
     * @param  string $uri 请求的URI
     * @return string
     */
    protected function buildUrl($uri)
    {
        return sprintf(
            '%s/%s/%s',
            $this->orgName,
            $this->appName,
            ltrim($uri, '/')
        );
    }

    /**
     * 获取 GuzzleHttp\Client
     *
     * @author Cong Peijun <congpeijun@tuozhongedu.com>
     * @return \GuzzleHttp\Client
     */
    public function getClient()
    {
        return $this->client;
    }

    private function getCacheFile()
    {
        return sys_get_temp_dir() . sprintf(
            '/%s_%s_%s',
            $this->getOrgName(),
            $this->getAppName(),
            'hxtoken.cache'
        );
    }

    /**
     * 获取access token
     *
     * @author Cong Peijun <congpeijun@tuozhongedu.com>
     * @return [type] [description]
     */
    public function getAccessToken()
    {
        $cacheFile = $this->getCacheFile();
        $now = time();
        if (is_file($cacheFile)) {
            $token = unserialize(file_get_contents($cacheFile));
            if ($token['expires_time'] - 1000 > $now) {
                return $token;
            }
        }
        $data = [
            'grant_type' => 'client_credentials',
            'client_id' => $this->getClientId(),
            'client_secret' => $this->getClientSecret(),
        ];

        try {
            $res = $this->client->post($this->buildUrl('/token'), ['json' => $data]);
            $this->accessToken = $this->getJson($res);
            $this->accessToken['expires_time'] = $now + $this->accessToken['expires_in'];
            file_put_contents($cacheFile, serialize($this->accessToken));
            return $this->accessToken;
        } catch (Exception $e) {
            throw $e;
        }
    }

    private function getAccessTokenString($token)
    {
        return sprintf(
            'Bearer %s',
            $token
        );
    }

    public function getAuthHeader()
    {
        $options = [];
        if ($token = $this->getAccessToken()) {
            $options['headers'] = ['Authorization' => $this->getAccessTokenString($token['access_token'])];
        }
        return $options;
    }

    /**
     * 生产请求参数
     *
     * @author Cong Peijun <congpeijun@tuozhongedu.com>
     * @param  请求数据 array $data
     * @param  boolean $requireAuth 是否发送请求认证token
     * @return array $options
     */
    public function getRequestOptions($data = [], $requireAuth = true)
    {
        $options = [];
        $data && $options['json'] = $data;
        if (true === $requireAuth) {
            $options += $this->getAuthHeader();
        }

        if (true === $this->async) {
            $options['future'] = true;
        }
        return $options;
    }

    /**
     * Gets the value of appName.
     *
     * @return mixed
     */
    public function getAppName()
    {
        return $this->appName;
    }

    /**
     * Sets the value of appName.
     *
     * @param mixed $appName the app name
     *
     * @return self
     */
    public function setAppName($appName)
    {
        $this->appName = $appName;
        return $this;
    }

    /**
     * Gets the value of orgName.
     *
     * @return mixed
     */
    public function getOrgName()
    {
        return $this->orgName;
    }

    /**
     * Sets the value of orgName.
     *
     * @param mixed $orgName the org name
     *
     * @return self
     */
    public function setOrgName($orgName)
    {
        $this->orgName = $orgName;
        return $this;
    }

    /**
     * Gets the value of clientId.
     *
     * @return mixed
     */
    public function getClientId()
    {
        return $this->clientId;
    }

    /**
     * Sets the value of clientId.
     *
     * @param mixed $clientId the client id
     *
     * @return self
     */
    public function setClientId($clientId)
    {
        $this->clientId = $clientId;
        return $this;
    }

    /**
     * Gets the value of clientSecret.
     *
     * @return mixed
     */
    public function getClientSecret()
    {
        return $this->clientSecret;
    }

    /**
     * Sets the value of clientSecret.
     *
     * @param mixed $clientSecret the client secret
     *
     * @return self
     */
    public function setClientSecret($clientSecret)
    {
        $this->clientSecret = $clientSecret;
        return $this;
    }

    public function setAsync()
    {
        $this->async = true;
    }
}

<?php
namespace Jiemo\Huanxin\Client;

use Exception;
use Jiemo\Huanxin\BaseClient;

class File extends BaseClient
{
    /**
     * 上传文件
     *
     * @author Cong Peijun <congpeijun@tuozhongedu.com>
     * @param  string $file 文件路径
     * @return array
     * @throw Exception
     */
    public function upload($file)
    {
        if (!file_exists($file)) {
            throw new Exception(sprintf('文件不存在 %s', $file));
        }

        $options = $this->getRequestOptions([], true);

        $options['headers']['restrict-access'] = 'true';

        $options['body'] = [
            'file' => fopen($file, 'r'),
        ];

        try {
            return $this->client->post(
                $this->buildUrl('/chatfiles'),
                $options
            )->json();
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function download($fileUuid, $shareSecret, $filename, $thumbnail = false)
    {
        $options = $this->getRequestOptions([], true);

        $options['headers']['share-secret'] = $shareSecret;
        $options['headers']['Accept'] = 'application/octet-stream';
        $options['stream'] = true;

        if ($thumbnail) {
            $options['headers']['thumbnail'] = 'true';
        }

        $response = $this->client->get(
            $this->buildUrl(sprintf('/chatfiles/%s', $fileUuid)),
            $options
        );

        $body = $response->getBody();

        $dirname = dirname($filename);
        if (!file_exists($dirname)) {
            mkdir($dirname, 0777, true);
        }
        $fh = fopen($filename, 'wa');
        while (!$body->eof()) {
            fwrite($fh, $body->read(1024), 1024);
        }
        fclose($fh);
    }
}

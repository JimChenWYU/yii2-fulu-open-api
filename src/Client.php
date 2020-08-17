<?php

namespace JimChen\OpenApiSDK;

use OpenApiSDK\Common\ApiGlobalConst;
use OpenApiSDK\DefaultOpenApiClient;
use OpenApiSDK\Model\InputCardOrderDto;
use OpenApiSDK\Model\InputDirectOrderDto;
use OpenApiSDK\Model\InputInterface;
use OpenApiSDK\Model\InputMatchPhoneProductListDto;
use OpenApiSDK\Model\InputOrderGetDto;
use OpenApiSDK\Model\InputPhoneOrderDto;
use OpenApiSDK\Model\InputProductDto;
use OpenApiSDK\Model\InputProductListDto;
use OpenApiSDK\Model\InputProductTemplateDto;
use OpenApiSDK\Model\InputUserDto;
use JimChen\Utils\Collection;
use yii\base\Component;

class Client extends Component
{
    /**
     * 沙箱测试
     */
    const SANDBOX_URL = 'http://pre.openapi.fulu.com/api/getway';
    /**
     * 正式环境
     */
    const PROD_URl = 'http://openapi.fulu.com/api/getway';
    /**
     * 是否是沙箱环境，布尔值
     *
     * @var bool
     */
    public $sandbox;
    /**
     * AppKey
     *
     * @var string
     */
    public $key;
    /**
     * AppSecret
     *
     * @var string
     */
    public $secret;

    /**
     * 获取请求地址
     *
     * @return string
     */
    private function getUrl()
    {
        if ((bool)$this->sandbox) {
            return self::SANDBOX_URL;
        }
        return self::PROD_URl;
    }

    /**
     * 请求发送
     *
     * @param string $method
     * @param InputInterface $dto
     * @return \stdClass|mixed
     */
    private function sendRequest($method, InputInterface $dto)
    {
        $defaultOpenApiClient = new DefaultOpenApiClient($this->getUrl(), $this->key, $this->secret, $method);
        $defaultOpenApiClient->setBizObject($dto);
        return $defaultOpenApiClient->excute();
    }

    /**
     * 处理返回结果
     *
     * @param array $result
     * @return Collection
     */
    private function handleResult($result)
    {
        return Collection::make($result);
    }

    /**
     * 直充下单接口
     *
     * @param InputDirectOrderDto $dto
     * @return Collection
     */
    public function directCharge(InputDirectOrderDto $dto)
    {
        return $this->handleResult(
            $this->sendRequest(ApiGlobalConst::OPEN_API_DIRECT_ORDER_ADD, $dto)
        );
    }

    /**
     * 卡密下单接口
     *
     * @param InputCardOrderDto $dto
     * @return Collection
     */
    public function cardCharge(InputCardOrderDto $dto)
    {
        return $this->handleResult(
            $this->sendRequest(ApiGlobalConst::OPEN_API_CARD_ORDER_ADD, $dto)
        );
    }

    /**
     * 花费下单接口
     *
     * @param InputPhoneOrderDto $dto
     * @return Collection
     */
    public function phoneCharge(InputPhoneOrderDto $dto)
    {
        return $this->handleResult(
            $this->sendRequest(ApiGlobalConst::OPEN_API_PHONE_ORDER_ADD, $dto)
        );
    }

    /**
     * 查询订单接口
     *
     * @param InputOrderGetDto $dto
     * @return Collection
     */
    public function getOrder(InputOrderGetDto $dto)
    {
        return $this->handleResult(
            $this->sendRequest(ApiGlobalConst::OPEN_API_ORDER_GET, $dto)
        );
    }

    /**
     * 获取商品列表接口
     *
     * @param InputProductListDto $dto
     * @return Collection
     */
    public function getProductList(InputProductListDto $dto)
    {
        return $this->handleResult(
            $this->sendRequest(ApiGlobalConst::OPEN_API_GOODS_LIST_GET, $dto)
        );
    }

    /**
     * 获取商品详情信息接口
     *
     * @param InputProductDto $dto
     * @return Collection
     */
    public function getProductDto(InputProductDto $dto)
    {
        return $this->handleResult(
            $this->sendRequest(ApiGlobalConst::OPEN_API_GOODS_GET, $dto)
        );
    }

    /**
     * 获取商品模板接口
     *
     * @param InputProductTemplateDto $dto
     * @return Collection
     */
    public function getProductTemplateDto(InputProductTemplateDto $dto)
    {
        return $this->handleResult(
            $this->sendRequest(ApiGlobalConst::OPEN_API_GOODS_TEMPLATE_GET, $dto)
        );
    }

    /**
     * 获取用户信息接口
     *
     * @param InputUserDto $dto
     * @return Collection
     */
    public function getUserInfo(InputUserDto $dto)
    {
        return $this->handleResult(
            $this->sendRequest(ApiGlobalConst::OPEN_API_USER_INFO_GET, $dto)
        );
    }

    /**
     * 获取手机号归属地接口
     *
     * @param InputMatchPhoneProductListDto $dto
     * @return Collection
     */
    public function getMobileInfo(InputMatchPhoneProductListDto $dto)
    {
        return $this->handleResult(
            $this->sendRequest(ApiGlobalConst::OPEN_API_CHECK_PHONE, $dto)
        );
    }
}

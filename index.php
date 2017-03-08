<?php

/**
 *
 */
class holyland
{
  private $token = '';
  private $appid = '';
  protected $appsecret = '';
  // public $data;
  public $accessToken = '';

  // 高级接口API根地址
  private $wechatApiBase = 'https://api.weixin.qq.com/cgi-bin';



  public function __construct($token,$appid = '',$appsecret = '')
  {
    $this->token = $token;
    $this->appid = $appid;
    $this->appsecret = $appsecret;
    if(isset($_GET['echostr'])){
      $this->checkToken();
    }
    $this->result();
  }

 /**
  * 验证服务器url是否存在
  */
  private function checkToken(){
    $signature = $_GET['signature'];
    $timestamp = $_GET['timestamp'];
    $nonce = $_GET['nonce'];
    $arr = array($this->token,$timestamp,$nonce);
    sort($arr);
    $arrString = sha1(implode($arr));
    if($signature=$arrString){
      echo $_GET['echostr'];
    }
  }

  /**
   *
   */
  public function result()
  {
    $postString = file_get_contents("php://input");
    // return simplexml_load_string($postStr,'SimpleXMLElement',LIBXML_NOCDATA);
    // $postString = $GLOBALS["HTTP_RAW_POST_DATA"];
    libxml_disable_entity_loader(true);
    $postObj = simplexml_load_string($postString, 'SimpleXMLElement', LIBXML_NOCDATA);
    return $postObj;
    // $this->data = $postObj;
    // if($postObj->MsgType == 'event'){
    //   if($postObj->Event=='subscribe')
    //   echo "大家好";
    // }
  }
  /**
     * 处理事件消息
     * @params $post post对象
     * @params $he 产生该事件的用户
     * @params $me 我
     */
    public function handle($post ,$fromUserName ="" ,$toUserName){
      // echo $toUserName;die();
      // $this->subscribe($fromUserName ,$toUserName);die();
        switch($post->Event){
            case 'subscribe'://如果是订阅事件，交给我们的订阅处理方法来处理
                $this->subscribe($fromUserName ,$toUserName);
                break;
        }
    }

    /**
      * 处理订阅事件
      */
     public function subscribe($fromUserName,$toUserName){
        //  echo "hello";die();
         $content = '欢迎订阅我们的微信公众号，欢迎加入我们的课程http://holylander.cn/user/login.php';
         $this->getTextMsg($fromUserName,$toUserName,time() ,$content);//调用我们上面写的获取一个回复消息的xml字符串的方法并输出
         exit;
     }

    /*
     * 获取一个文本消息的xml字符串
     * @params $to 发送的目标用户
     * @params $from 发送者
     * @params $time 发送时间戳
     * @params $content 发送内容
     * @return XML String 文本消息的xml字符串
     */
    public function getTextMsg($fromUserName,$toUserName,$time,$content){
        $tpl = '<xml>
                <ToUserName><![CDATA[%s]]></ToUserName>
                <FromUserName><![CDATA[%s]]></FromUserName>
                <CreateTime>%s</CreateTime>
                <MsgType><![CDATA[text]]></MsgType>
                <Content><![CDATA[%s]]></Content>
                </xml>';
        // echo $tpl;die();
        $result = sprintf($tpl,$fromUserName,$toUserName,$time,$content);
        echo $result;
    }

    public function createMenu($data){
      $url = "{$this->wechatApiBase}/menu/create";
      $param = array('access_token'=>$this->accessToken);
      $post_param['button'] = $data;
      array_walk_recursive($post_param,function(&$value){
        $value = urlencode($value);//不转换的话会形成中文乱码
      });
      $post_param = urldecode(json_encode($post_param));
      $res = self::http($url,$param,$post_param,'POST');
      return json_decode($res,true);
    }

    //获取网页授权
    //获取accessToken
    public function getAccessToken($code=''){
      $url = "{$this->wechatApiBase}/token";
      $param = array(
        'grant_type' => 'client_credential',
        'appid'=>$this->appid,
        'secret'=>$this->appsecret
      );
      $res = self::http($url,$param);

      $access = json_decode($res,true);
      if(!empty($access)){
        $this->accessToken = $access['access_token'];
      }else{
        throw new Exception("AccessToken获取失败",1);
      }
      return $access;
    }


    public static function http($url,$param = '',$data = '',$method = "GET"){
  		$opts = array(
  			CURLOPT_TIMEOUT => 30,
  			CURLOPT_RETURNTRANSFER => 1,
  			CURLOPT_SSL_VERIFYHOST => false,
  			CURLOPT_SSL_VERIFYPEER => false
  		);

  		//根据get请求参数组织新的url地址
  		$opts[CURLOPT_URL] = $url . '?' . http_build_query($param);

  		//进行post提交
  		if($method == 'POST'){
  			$opts[CURLOPT_POST] = true;
  			$opts[CURLOPT_POSTFIELDS] = $data;

  			if(is_string($data)){
  				$opts[CURLOPT_HTTPHEADER] = array(
  					'Content-Type: application/json',
  					'Content-Length: ' . strlen($data)
  				);
  			}
  		}

  		//执行改curl请求
  		$ch = curl_init();
  		curl_setopt_array($ch,$opts);
  		$res = curl_exec($ch);
  		curl_close($ch);
  		return $res;
  	}

}

$menu = array(
   array('type' =>  'view',
         'name' => '进入课程',
         'url'  => 'http://holylander.cn/user/login.php'
    )
  );

$holyland = new holyland('holyland','wx09bca3ee29d7b108','45a4289739529203501561dd90951ec6');
$holyland->getAccessToken();
$res = $holyland->createMenu($menu);
echo "<pre>";
print_r($res);

$post = $holyland->result();
if(empty($post)){
    echo "nothing";
    exit;
}
$fromUserName = $post->FromUserName;//与我们发生事件的用户
$toUserName = $post->ToUserName;//我们自己的公众号
$msgType = $post->MsgType;//消息类型
//判断消息类型 实例化处理器类(两个处理类在下面书写)
// $holyland->handle($post ,$fromUserName ,$toUserName);//处理方法
switch($msgType){
    case 'event'://判断是否为事件消息
        $holyland->handle($post ,$fromUserName ,$toUserName);//处理方法
        break;
    default ://如果为普通消息走这里
}

//45a4289739529203501561dd90951ec6

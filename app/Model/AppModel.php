<?php
/**
 * Application model for CakePHP.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       app.Model
 * @since         CakePHP(tm) v 0.2.9
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Model', 'Model');

/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       app.Model
 */
class AppModel extends Model {
    protected function __getCurrentUserId() {
        App::uses('CakeSession', 'Model/Datasource');
        $Session = new CakeSession();
        $user_id = $Session->read('Auth.User.id');
        return $user_id;
    }
    /**
     * データ収集の際の階層のズレを調整
     */
    public function toFlat($old_arr,$index_key){
        $new_arr = array();
        array_walk_recursive($old_arr,function($val,$key) use (&$id,&$new_arr,$index_key) {
            $new_arr[$key == $index_key ? ($id = $val) : $id][$key] = $val;
        });
        $new_arr = array_values($new_arr);
        return $new_arr;
    }
    
    /**
     * 配列の重複削除
     */
    public function uniqueIndex($arr){
        foreach($arr as $key => $value ){
            $tmp[] = $value;
        }
        $result_arr = array_unique($tmp);
        return $result_arr;
    }

    public function getKeyphrase($text){
		$output	= 'json';
		$appid	= 'dj0zaiZpPTRFTXJRWm80VDROWCZzPWNvbnN1bWVyc2VjcmV0Jng9MzI-';
		$url 	= 'http://jlp.yahooapis.jp/KeyphraseService/V1/extract?';
		$req 	= $url.'appid='.$appid.'&sentence='.urlencode($text).'&output='.$output;
		$res 	= file_get_contents($req);
		$result = json_decode($res);
		return $result;
	}

}
<?php
class Template extends AppModel{
	public $useDbConfig = 'make';
	public $name = 'Template';

	public function generateQuestions($searched_knowledge,$object_list){
		App::import('Model','Knowledge');
		$Knowledge = new Knowledge;

		$question_num = 0;
		$templates_list = $this->find('all');

		foreach ($searched_knowledge as $knowledge_row => $knowledge){
			if($knowledge['Knowledge']['level_flag'] == 1){
				$knowledge_level_is_1[$knowledge_row]['id'] = $knowledge['Knowledge']['id'];
				$knowledge_level_is_1[$knowledge_row]['resources_id'] = $knowledge['Knowledge']['resources_id'];
				$knowledge_level_is_1[$knowledge_row]['categories_id'] = $knowledge['Knowledge']['categories_id'];
				$knowledge_level_is_1[$knowledge_row]['target_knowledge'] = $knowledge['Knowledge']['target_knowledge'];
				$knowledge_level_is_1[$knowledge_row]['object'] = $knowledge['Knowledge']['object'];
				$knowledge_level_is_1[$knowledge_row]['property'] = $knowledge['Knowledge']['property'];
				$knowledge_level_is_1[$knowledge_row]['level_flag'] = $knowledge['Knowledge']['level_flag'];
			}
			if($knowledge['Knowledge']['level_flag'] == 2){
				$knowledge_level_is_2[$knowledge_row]['id'] = $knowledge['Knowledge']['id'];
				$knowledge_level_is_2[$knowledge_row]['resources_id'] = $knowledge['Knowledge']['resources_id'];
				$knowledge_level_is_2[$knowledge_row]['categories_id'] = $knowledge['Knowledge']['categories_id'];
				$knowledge_level_is_2[$knowledge_row]['target_knowledge'] = $knowledge['Knowledge']['target_knowledge'];
				$knowledge_level_is_2[$knowledge_row]['object'] = $knowledge['Knowledge']['object'];
				$knowledge_level_is_2[$knowledge_row]['property'] = $knowledge['Knowledge']['property'];
				$knowledge_level_is_2[$knowledge_row]['level_flag'] = $knowledge['Knowledge']['level_flag'];
			}
		}

		foreach ($templates_list as $template) {
			if($template['Template']['id'] == 1){
				// 知識レベルが１のもののみ抽出
				foreach ($knowledge_level_is_1 as $knowledge_to_P1X) {
					foreach ($knowledge_level_is_1 as $knowledge_to_P1Y) {
						if(isset($knowledge_to_P1Y)){
							// 同一のプロパティは二度挿入しない
							if($knowledge_to_P1X['id'] != $knowledge_to_P1Y['id']){
								$maked_question[$question_num]['sentence'] = str_replace(
									"[P1X]",
									$knowledge_to_P1X['property'],
									$template['Template']['sentence']
								);
								$maked_question[$question_num]['sentence'] = str_replace(
									"[P1Y]",
									$knowledge_to_P1Y['property'],
									$maked_question[$question_num]['sentence']
								);
								$maked_question[$question_num]['answer'] = str_replace(
									"[O1]",
									$knowledge_to_P1Y['object'],
									$template['Template']['answer']
								);
								$maked_question[$question_num]['use_template'] = $template['Template']['id'];
								$maked_question[$question_num]['use_knowledge'] = $knowledge_to_P1X['id'].','.$knowledge_to_P1Y['id'];
								$question_num++;
							}
						}
					}
				}
			}else if($template['Template']['id'] == 2){
				if(isset($knowledge_level_is_1) && isset($knowledge_level_is_2)){
					foreach ($knowledge_level_is_1 as $knowledge_to_P1O1) {
						foreach ($knowledge_level_is_2 as $knowledge_to_P2O2) {
							if(stristr($knowledge_to_P2O2['property'],$knowledge_to_P1O1['object'])){
								$maked_question[$question_num]['sentence'] = str_replace(
									'[P1]',
									$knowledge_to_P1O1['property'],
									' [P1] である [O1] '
								);
								$maked_question[$question_num]['sentence'] = str_replace(
									"[O1]",
									$knowledge_to_P1O1['object'],
									$maked_question[$question_num]['sentence']
								);

								$maked_question[$question_num]['sentence'] = str_replace(
									$knowledge_to_P1O1['object'],
									$maked_question[$question_num]['sentence'],
									$knowledge_to_P2O2['property'].' のは何か'
								);

								$maked_question[$question_num]['answer'] = str_replace(
									"[O2]",
									$knowledge_to_P2O2['object'],
									$template['Template']['answer']
								);
								$maked_question[$question_num]['use_template'] = $template['Template']['id'];
								$maked_question[$question_num]['use_knowledge'] = $knowledge_to_P1O1['id'].','.$knowledge_to_P2O2['id'];
								$question_num++;
							}
						}
					}
				}
			}else if($template['Template']['id'] == 3){
				if(isset($knowledge_level_is_1)){
					foreach ($knowledge_level_is_1 as $knowledge_to_P1_O1_Y) {
						foreach ($object_list as $object_name) {
							if(stristr($knowledge_to_P1_O1_Y['property'],$object_name) && ($object_name != $knowledge_to_P1_O1_Y['object'])){
								$searched_knowledge_by_object_name = $Knowledge->find('list',array(
									'fields' => array('Knowledge.id','Knowledge.property'),
									'conditions' => array(
										'Knowledge.object' => $object_name,
										'Knowledge.level_flag' => 1)
								));
								// if(isset($searched_knowledge_by_object_name)){
									foreach ($searched_knowledge_by_object_name as $knowledge_to_P1_O1_X_id => $knowledge_to_P1_O1_X) {
										// return $knowledge_to_P1_O1_X;
										$maked_question[$question_num]['sentence'] = str_replace(
											"[P1X]",
											$knowledge_to_P1_O1_X,
											" [P1X] である [O1X] "
										);
										$maked_question[$question_num]['sentence'] = str_replace(
											"[O1X]",
											$object_name,
											$maked_question[$question_num]['sentence']
										);
										$maked_question[$question_num]['sentence'] = str_replace(
											$object_name,
											$maked_question[$question_num]['sentence'],
											$knowledge_to_P1_O1_Y['property'].' のは何か'
										);
										$maked_question[$question_num]['answer'] = str_replace(
											"[O1Y]",
											$knowledge_to_P1_O1_Y['object'],
											$template['Template']['answer']
										);
										$maked_question[$question_num]['use_template'] = $template['Template']['id'];
										$maked_question[$question_num]['use_knowledge'] = $knowledge_to_P1_O1_Y['id'].','.$knowledge_to_P1_O1_X_id;
										$question_num++;
									}
								// }
							}
						}
					}
				}
			}
			// else if($template['Template']['id'] == 4){
			// 	if(isset($knowledge_level_is_2)){
			// 		foreach ($knowledge_level_is_2 as $knowledge_to_P2_O2) {
			// 			foreach ($object_list as $object_name) {
			// 				if(stristr($knowledge_to_P2_O2['property'],$object_name) && ($object_name != $knowledge_to_P2_O2['object'])){
			// 					$searched_knowledge_by_object_name = $Knowledge->find('list',array(
			// 						'fields' => array('Knowledge.id','Knowledge.property'),
			// 						'conditions' => array(
			// 							'Knowledge.object' => $object_name,
			// 							'Knowledge.level_flag' => 1)
			// 					));
			// 					if(isset($searched_knowledge_by_object_name)){
			// 						foreach ($searched_knowledge_by_object_name as $knowledge_to_P1_O1_id => $knowledge_to_P1_O1) {
			// 							// return $knowledge_to_P1_O1_X;
			// 							$maked_question[$question_num]['sentence'] = str_replace(
			// 								"[P1]",
			// 								$knowledge_to_P1_O1,
			// 								" [P1] である [O1] "
			// 							);
			// 							$maked_question[$question_num]['sentence'] = str_replace(
			// 								"[O1]",
			// 								$object_name,
			// 								$maked_question[$question_num]['sentence']
			// 							);
			// 							$maked_question[$question_num]['sentence'] = str_replace(
			// 								$object_name,
			// 								$maked_question[$question_num]['sentence'],
			// 								$knowledge_to_P2_O2['property'].' のは何か'
			// 							);
			// 							$maked_question[$question_num]['answer'] = str_replace(
			// 								"[O2]",
			// 								$knowledge_to_P2_O2['object'],
			// 								$template['Template']['answer']
			// 							);
			// 							$maked_question[$question_num]['use_template'] = $template['Template']['id'];
			// 							$maked_question[$question_num]['use_knowledge'] = $knowledge_to_P2_O2['id'].','.$knowledge_to_P1_O1_id;
			// 							$question_num++;
			// 						}
			// 					}
			// 				}
			// 			}
			// 		}
			// 	}
			// }
			else if($template['Template']['id'] == 4){
				foreach ($knowledge_level_is_1 as $knowledge_to_P1O1) {
					$maked_question[$question_num]['sentence'] = str_replace(
						"[O1]",
						$knowledge_to_P1O1['object'],
						$template['Template']['sentence']
					);
					$maked_question[$question_num]['answer'] = str_replace(
						"[P1]",
						$knowledge_to_P1O1['property'],
						$template['Template']['answer']
					);
					$maked_question[$question_num]['use_template'] = $template['Template']['id'];
					$maked_question[$question_num]['use_knowledge'] = $knowledge_to_P1O1['id'];
					$question_num++;
				}
			}else if($template['Template']['id'] == 5){
				if(isset($knowledge_level_is_2)){
					foreach ($knowledge_level_is_1 as $knowledge_to_P1) {
						foreach ($knowledge_level_is_2 as $knowledge_to_P2O2) {
							$maked_question[$question_num]['sentence'] = str_replace(
								"[O1]",
								$knowledge_to_P1O1['object'],
								$template['Template']['sentence']
							);
							$maked_question[$question_num]['answer'] = str_replace(
								"[P2]",
								$knowledge_to_P2O2['property'],
								$template['Template']['answer']
							);
							$maked_question[$question_num]['answer'] = str_replace(
								"[O2]",
								$knowledge_to_P2O2['object'],
								$maked_question[$question_num]['answer']
							);
							$maked_question[$question_num]['use_template'] = $template['Template']['id'];
							$maked_question[$question_num]['use_knowledge'] = $knowledge_to_P1['id'].','.$knowledge_to_P2O2['id'];
							$question_num++;
						}
					}
				}
			}
		}
		return $maked_question;
	}
}

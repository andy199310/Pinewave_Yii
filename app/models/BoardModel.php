<?php
/**
 * Created by IntelliJ IDEA.
 * User: Green
 * Date: 2013/8/7
 * Time: 下午 6:22
 */

class BoardModel{

	public function getBoardData($display = 10, $page = 1){
		$connection = Yii::app()->db;

		$board_query = "SELECT *
						FROM `board`
						WHERE `fid` = '0'
						ORDER BY `id` DESC
						LIMIT :page , :display";
		$respond_query="SELECT *
						FROM `board`
						WHERE `fid` = :ID
						ORDER BY `id`";

		$tmpP = ($page-1)*$display;

		$command = $connection->createCommand($board_query);
		$command->bindParam(':page', $tmpP, PDO::PARAM_INT);
		$command->bindParam(':display', $display, PDO::PARAM_INT);
		$data = $command->queryAll();

		for($i=0; $i<count($data); $i++){
			$data[$i]['time'] = preg_replace("/[0-9]{4}-([0-9]{2})-([0-9]{2})/","\\1/\\2",$data[$i]['time']);

			$respond_rs = $connection->createCommand($respond_query);
			$respond_rs->bindParam(':ID', $data[$i]['id'], PDO::PARAM_INT);
			$respond_rs->execute();
			$respond_as = $respond_rs->queryAll();
			foreach($respond_as as $as_value)
			{
				$data[$i]['re_time'] = preg_replace("/[0-9]{4}-([0-9]{2})-([0-9]{2})/","\\1/\\2",$as_value['time']);
				$data[$i]['re_name'] = $as_value['author'];
				$data[$i]['re_content'] = $as_value['content'];
			}
		}
		return $data;
	}

	public static function getBoardBlock($data){
		$tmp  = '<div class="board_block_main">';
		$tmp .= '<div class="board_block_top">';
		$tmp .= '<div class="board_block_top_left">'.'留言者：'.$data['author'].' ('.$data['time'].')</div>';
		$tmp .= '<div class="board_block_top_button">點我留言</div>';
		$tmp .= '<div class="board_block_top_content">'.$data['content'].'</div>';
		$tmp .= '</div>';

		if(isset($data['re_time'])){
			$tmp .= '<div class="board_block_down_title">'.'回覆者：'.$data['re_name'].' ('.$data['re_time'].')</div>';
			$tmp .= '<div class="board_block_down_content">'.$data['re_content'].'</div>';
		}

		$tmp  .='</div>';
		return $tmp;
	}
}
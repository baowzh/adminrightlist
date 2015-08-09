<?php
/**
 * 类别管理
 *
 * @author
 */
import ( "ORG.Util.Page" );
import ( "ORG.Net.UploadFile" );
import ( "@.ORG.file" );
class classAction extends CommonAction {
	/**
	 * 类别列表
	 */
	public function lists() {
		$Classi = M ( "Class" );
		if (! empty ( $_GET ['names'] )) {
			$where ["names"] = array (
					"like",
					"%{$_GET['names']}%" 
			);
			$this->assign ( "names", $_GET ['names'] );
		} else {
			$where = '1=1';
		}
		$count = $Classi->where ( $where )->count ();
		$page = $this->pagebar ( $count );
		$list = $Classi->page ( $page )->where ( $where )->order ( 'id ' )->select ();
		$this->assign ( 'list', $list );
		$this->display ();
	}
	/**
	 * 添加类别
	 */
	public function add() {
		if (! $_POST) {
			$Classi = M ( 'Class' );
			$arr = $Classi->select ();
			$this->assign ( 'lists', $arr );
			$this->display ();
		} else {
			$Classi = D ( 'Class' );
			if ($iuoi = $Classi->create ()) {
				$Classi->add ( $iuoi );
				$this->success ( '添加成功', U ( "lists" ) );
			} else {
				$this->error ( '添加失败.' . $Classi->getError (), U ( "lists" ) );
			}
		}
	}
	/**
	 * 编辑类别
	 */
	public function edit() {
		if (! $_POST) {
			$Classi = M ( 'Class' );
			$id = $_GET ['id'];
			$classinfo = $Classi->where ( "id='$id'" )->find ();
			$this->assign ( 'classinfo', $classinfo );
			$this->display ();
		} else {
			$Classi = M ( 'Class' );
			if ($data = $Classi->create ()) {
				$Classi->save ( $data );
				$this->success ( '编辑成功', U ( "lists" ) );
			} else {
				$this->error ( '编辑失败.' . $Classi->getError () );
			}
		}
	}
	/**
	 * 删除类别
	 */
	public function del() {
		$Classi = M ( 'Class' );
		$id = $_GET ['id'];
		$classinfo = $Classi->where ( "id='$id'" )->find ();
		$Adminright = M ( 'Adminright' );
		$projectlist=$Adminright->where("classcode='".$id."'")->select();
		if(count($projectlist)>0){
			$this->error ( '删除失败,此类别下已经维护权利清单信息，不能删除。' ,U ( "lists" ) );
		}
		if ($Classi->where ( "id='$id'" )->delete ()) {
			$this->success ( '删除成功', U ( "lists" ) );
		} else {
			$this->error ( '删除失败.' . $Classi->getError () );
		}
	}
	public function deleteall() {
		if (! isset ( $_POST ["deleteall"] )) {
			$this->error ( "至少选中一项！" );
		}
		$Class = M ( 'Class' );
		foreach ( $_POST ["deleteall"] as $id ) {
			$Adminright = M ( 'Adminright' );
			$projectlist=$Adminright->where("departid='".$id."'")->select();
			if(count($projectlist)>0){
				$this->error ( '删除失败,此类别下已经维护权利清单信息，不能删除。' ,U ( "lists" ) );
			}
			$Class->where ( "id='$id'" )->delete ();
		}
		$this->success ( "删除成功", U ( "lists" ) );
		
	}
}

?>
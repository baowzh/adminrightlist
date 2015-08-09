<?php
/**
 * 部门管理
 *
 * @author
 */
import ( "ORG.Util.Page" );
import ( "ORG.Net.UploadFile" );
import ( "@.ORG.file" );
class departAction extends CommonAction {
	/**
	 * 部门列表
	 */
	public function lists() {
		$Depart = M ( "Depart" );
		if (! empty ( $_GET ['names'] )) {
			$where ["names"] = array (
					"like",
					"%{$_GET['names']}%" 
			);
			$this->assign ( "names", $_GET ['names'] );
		} else {
			$where = '1=1';
		}
		$count = $Depart->where ( $where )->count ();
		$page = $this->pagebar ( $count);
		$list = $Depart->page ( $page )->where ( $where )->order ( ' code ' )->select ();
		$this->assign ( 'list', $list );
		$this->display ();
	}
	/**
	 * 添加部门
	 */
	public function add() {
		if (! $_POST) {
			$Depart = M ( 'Depart' );
			$arr = $Depart->select ();
			$this->assign ( 'lists', $arr );
			$this->display ();
		} else {
			$Depart = D ( 'Depart' );
			if ($iuoi = $Depart->create ()) {
				$Depart->add ( $iuoi );
				$this->success ( '添加成功', U ( "lists" ) );
			} else {
				$this->error ( '添加失败.' . $Depart->getError (), U ( "lists" ) );
			}
		}
	}
	/**
	 * 编辑部门
	 */
	public function edit() {
		if (! $_POST) {
			$Depart = M ( 'Depart' );
			$id = $_GET ['id'];
			$depart = $Depart->where ( "id='$id'" )->find ();
			$this->assign ( 'depart', $depart );
			$this->display ();
		} else {
			$Depart = M ( 'Depart' );
			if ($data = $Depart->create ()) {
				$Depart->save ( $data );
				$this->success ( '编辑成功', U ( "lists" ) );
			} else {
				$this->error ( '编辑失败.' . $Depart->getError () );
			}
		}
	}
	/**
	 * 删除部门
	 */
	public function del() {
		$Depart = M ( 'Depart' );
		$id = $_GET ['id'];
		$departinfo = $Depart->where ( "id='$id'" )->find ();
		//如果已经存在项目不能删除
		$Adminright = M ( 'Adminright' );
		$projectlist=$Adminright->where("departid='".$id."'")->select();
		if(count($projectlist)>0){
			$this->error ( '删除失败,此部门已经维护权利清单信息，不能删除。' ,U ( "lists" ) );
		}
		
		if ($Depart->where ( "id='$id'" )->delete ()) {
			$this->success ( '删除成功', U ( "lists" ) );
		} else {
			$this->error ( '删除失败.' . $Depart->getError () );
		}
	}
	public function deleteall() {
		if (! isset ( $_POST ["deleteall"] )) {
			$this->error ( "至少选中一项！" );
		}
		$Depart = M ( 'Depart' );
		foreach ( $_POST ["deleteall"] as $id ) {
			$Adminright = M ( 'Adminright' );
			$projectlist=$Adminright->where("departid='".$id."'")->select();
			if(count($projectlist)>0){
				$this->error ( '删除失败,此部门已经维护权利清单信息，不能删除。' ,U ( "lists" ) );
			}
			$Depart->where ( "id='$id'" )->delete ();
		}
		$this->success ( "删除成功", U ( "lists" ) );
	}
}

?>
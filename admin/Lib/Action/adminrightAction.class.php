<?php
import ( "ORG.Util.Page" );
import ( "ORG.Net.UploadFile" );
import ( "@.ORG.file" );
class adminrightAction extends CommonAction {
	
	/**
	 * 添加权利清单
	 */
	public function add() {
		if (! isset ( $_POST ['submit'] )) {
			// 所属地区列表
			// 1.获取部门列表
			$Depart = M ( 'Depart' );
			$departs = $Depart->select ();
			$this->assign ( 'departs', $departs );
			$Classi = M ( 'Class' );
			$classes = $Classi->select ();
			$this->assign ( 'classes', $classes );
			$Adminright = M ( 'Adminright' );
			// $adminrights=$Adminright->select();
			//
			$adminrights = $Adminright->where ( $where )->field ( $Adminright->getTableName () . ".*, (select count(1) from " . $Adminright->getTableName () . " a where a.parentid=" . $Adminright->getTableName () . ".id ) as haschild " )->order ( 'id asc' )->select ();
			//
			$this->assign ( 'adminrights', $adminrights );
			// 2.获取类别
			$this->display ();
		} else {
			$Adminright = M ( 'Adminright' );
			$admininfo = $Adminright->create ();
			//print_r ( $admininfo );
			if ($_POST ['parentid'] == null || $_POST ['parentid'] == '' || $admininfo->parentid == null || $admininfo->parentid == '' || $admininfo->parentid == 0 ) {
				$admininfo->parentid = null;
				$Adminright->parentid = null;
				//print_r ( $admininfo );
			}else{
				// 校验上级项目和下级项目部门是否相同
				//print_r($admininfo.parentid);
				$Adminrightk = M ( 'Adminright' );
				$departidk=$Adminrightk->field('departid')->where("id=".$Adminright->parentid."")->find();
				print_r($departidk['departid']);
				print_r($admininfo['departid']);
				if($departidk['departid']!=$admininfo['departid']){
					$this->error ( '添加失败.' . '上级项目所属部门和当前项目所属部门不同，请确认。', U ( "lists" ) );
				}
				$admininfo['parentid'] = $_POST ['parentid'];
				print_r($admininfo['parentid']);
				//exit();
			}
			//$admininfo['parentid'] = $_POST ['parentid'];
			//echo $admininfo->$admininfo['parentid'];
			//exit();
			if($_POST ['parentid']!=null){
				$Adminright->add ($admininfo);
			}else{
				$Adminright->add ();
			}
		    
			$this->redirect ( "show_list" );
		}
	}
	
	/**
	 * 编辑权利清单
	 */
	public function edit() {
		if (! isset ( $_POST ['submit'] )) {
			$id = $_GET ['id'];
			$Adminright = M ( 'Adminright' );
			$map ["id"] = array (
					"eq",
					$id 
			);
			$objAdminright = $Adminright->where ( $map )->find ();
			$this->assign ( 'adminright', $objAdminright );
			$Depart = M ( 'Depart' );
			$departs = $Depart->select ();
			$this->assign ( 'departs', $departs );
			$Classi = M ( 'Class' );
			$classes = $Classi->select ();
			$this->assign ( 'classes', $classes );
			$Adminright = M ( 'Adminright' );
			$adminrights = $Adminright->join ( M ( 'Adminright' )->getTableName () . " adright on adright.id=" . $Adminright->getTableName () . ".parentid" )->field ( "" . $Adminright->getTableName () . ".*,adright.projectname as parentname" )->where ( $Adminright->getTableName () . ".id=" . $id )->select ();
			$adminjsoninfo = json_encode ( $adminrights );
			$this->assign ( 'adminjsoninfo', $adminjsoninfo );
			// $adminrights=$Adminright->select();
			$adminrights = $Adminright->where ( $where )->field ( $Adminright->getTableName () . ".*, (select count(1) from " . $Adminright->getTableName () . " a where a.parentid=" . $Adminright->getTableName () . ".id ) as haschild " )->order ( 'id asc' )->select ();
			$this->assign ( 'adminrights', $adminrights );
			$this->display ();
		} else {
			$Adminright = M ( 'Adminright' );
			$Adminright->create ();
			$Adminright->id = $_POST ['id'];
			$Adminright->names = $_POST ['names'];
			if ($_POST ['parentid'] == null) {
				$Adminright->parentid = null;
			}
			$Adminright->save ();
			$this->redirect ( "show_list" );
		}
	}
	/**
	 * 删除权利清单
	 */
	public function del() {
		$id = $_GET ['id'];
		$Adminright = M ( 'Adminright' );
		$Adminrightk = M ( 'Adminright' );
		// 有下级权利清但择不能删除
		$childlist=$Adminrightk->where("parentid='".$id."'")->select();
		if(count($childlist)>0){
			$this->error ( '删除失败.' . '此项目存在下级项目,先删除下级项目再删除此项目。', U ( "lists" ) );
		 return ;
		}
		$Adminright->where ( "id=$id" )->delete ();
		$this->redirect ( "show_list" );
	}
	/**
	 * 权利你清单列表
	 */
	public function show_list() {
		$Depart = M ( 'Depart' );
		$Classi = M ( 'Class' );
		$Adminright = M ( "Adminright" );
		if($_GET){
			if (! empty ( $_GET ['projectname'] )) {
				$where ["projectname"] = array (
						"like",
						"%{$_GET['projectname']}%"
				);
					
				$this->assign ( "projectname", $_GET ['projectname'] );
			} else {
				// $where = '1=1';
			}
			if (! empty ( $_GET ['departid'] )) {
				$where ["departid"] = array (
						"eq",
						"{$_GET['departid']}"
				);
			}
		}else{
			if (! empty ( $_POST ['projectname'] )) {
				$where ["projectname"] = array (
						"like",
						"%{$_POST['projectname']}%"
				);
					
				$this->assign ( "projectname", $_POST ['projectname'] );
			} else {
				// $where = '1=1';
			}
			if (! empty ( $_POST ['departid'] )) {
				$where ["departid"] = array (
						"eq",
						"{$_POST['departid']}"
				);
			}
		}
		
		
		$where ['parentid'] = array (
				"exp",
				'IS NULL' 
		);
		$count = $Adminright->where ( $where )->count ();
		$page = $this->pagebar ( $count );
		$list =$Adminright-> page ( $page )->where ( $where )->field ( $Adminright->getTableName () . ".*, (select count(1) from " . $Adminright->getTableName () . " a where a.parentid=" . $Adminright->getTableName () . ".id ) as haschild,(select names from " . $Depart->getTableName () . " a where a.id=" . $Adminright->getTableName () . ".departid ) as departname,(select names from " . $Classi->getTableName () . " a where a.id=" . $Adminright->getTableName () . ".classcode ) as classname  " )->order ( 'parentid,id' )->select ();
		$newList = array ();
		foreach ( $list as $key => $value ) {
			$Adminrighti = M ( "Adminright" );
			$listnew = $this->getChild ( $value ['id'], array () );
			if (! empty ( $listnew )) {
				$newList = array_merge ( $newList, $listnew );
			}
		}
		$list = array_merge ( $list, $newList );
	    sort ( $list   );
		$this->assign ( 'list', $list );
		$departs= $Depart->select();
		$this->assign ( 'departs',$departs );
		$this->display ();
	}
	private function getChild($parentid, $list) {
		$Depart = M ( 'Depart' );
		$Classi = M ( 'Class' );
		$Adminrighti = M ( "Adminright" );
		$wherei = array (
				'parentid' => $parentid 
		);
		$listi = $Adminrighti->where ( $wherei )->field ( $Adminrighti->getTableName () . ".*, (select count(1) from " . $Adminrighti->getTableName () . " a where a.parentid=" . $Adminrighti->getTableName () . ".id ) as haschild,(select names from " . $Depart->getTableName () . " a where a.id=" . $Adminrighti->getTableName () . ".departid ) as departname,(select names from " . $Classi->getTableName () . " a where a.id=" . $Adminrighti->getTableName () . ".classcode ) as classname  " )->order ( 'id asc' )->select ();
		
		if (! empty ( $listi )) {
			foreach ( $listi as $keyi => $valuei ) {
				$listnew = $this->getChild ( $valuei ['id'], array () );
				if (! empty ( $listnew )) {
					$listi = array_merge ( $listi, $listnew );
				}
			}
			$list = array_merge ( $list, $listi );
			// print_r($list);
			return $list;
		} else {
			return $list;
		}
	}
	function ARRAY_sort_by_field($arr_data, $field, $descending = false)
	{
		$arrSort = array();
		foreach ( $arr_data as $key => $value ) {
			$arrSort[$key] = $value[$field];
		}
	
		if( $descending ) {
			arsort($arrSort);
		} else {
			asort($arrSort);
		}
	
		$resultArr = array();
		foreach ($arrSort as $key => $value ) {
			$resultArr[$key] = $arr_data[$key];
		}
	
		return $resultArr;
	}
	public function getProjects() {
		$departid = $_GET ['departid'];
		$classid = $_GET ['classcode'];
		$where = array ();
		if (! empty ( $departid )) {
			$where ["departid"] = array (
					"eq",
					"{$departid}" 
			);
		}
		if (! empty ( $classid )) {
			$where ["classcode"] = array (
					"eq",
					"{$classid}" 
			);
		}
		$Depart = M ( 'Depart' );
		$Classi = M ( 'Class' );
		$Adminright = M ( "Adminright" );
		$adminrights = $Adminright->where ( $where )->field ( $Adminright->getTableName () . ".*, (select count(1) from " . $Adminright->getTableName () . " a where a.parentid=" . $Adminright->getTableName () . ".id ) as haschild,(select names from " . $Depart->getTableName () . " a where a.id=" . $Adminright->getTableName () . ".departid ) as departname,(select names from " . $Classi->getTableName () . " a where a.id=" . $Adminright->getTableName () . ".classcode ) as classname  "  )->order ( 'id asc' )->select ();
	//	$list = $Adminright->where ( $where )->select ();
		$this->assign ( 'adminrights', $adminrights );
	    $this->display("list");
	}
}

?>
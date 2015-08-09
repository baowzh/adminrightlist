<?php
class indexAction extends CommonAction {
	protected $authentic = 0;
	public function _initialize() {
		C ( "TOKEN_ON", false );
		parent::_initialize ();
	}
	/**
	 * 系统前台首页
	 */
	public function index() {
		// 网站公告
		$departid = $_GET ['departid'];
		$classid = $_GET ['classid'];
		$projectname = $_GET ['projectname'];
		if ($_POST) {
			$departid = $_POST ['departid'];
			$classid = $_POST ['classid'];
			$projectname = $_POST ['projectname'];
		}
		$Depart = M ( 'Depart' );
		$departs = $Depart->select ();
		// 把数据2条写入一航记录中
		$returnDeparts = array ();
		$index = - 1;
		foreach ( $departs as $key => $value ) {
			if ($key % 2 == 0) {
				$row = array ();
				$row [1] = $value;
				$index ++;
				$returnDeparts [$index] = $row;
			} else {
				$row [2] = $value;
				$returnDeparts [$index] = $row;
			}
		}
		$this->assign ( 'departs', $returnDeparts );
		$this->assign ( 'departs1', $departs );
		$Classi = M ( 'Class' );
		$classes = $Classi->select ();
		$this->assign ( 'classes1', $classes );
		//
		$returnClasses = array ();
		$index = - 1;
		foreach ( $classes as $key => $value ) {
			if ($key % 2 == 0) {
				$row = array ();
				$row [1] = $value;
				$index ++;
				$returnClasses [$index] = $row;
			} else {
				$row [2] = $value;
				$returnClasses [$index] = $row;
			}
		}
		$this->assign ( 'classes', $returnClasses );
		// 获取行政权利清单
		$Adminright = M ( 'Adminright' );
		$hasclassid = 0;
		$hasdepartid = 0;
		$where = array ();
		if (! empty ( $classid )) {
			$where ["classcode"] = array (
					"eq",
					"{$classid}" 
			);
			$hasclassid = 1;
		}
		if (! empty ( $departid )) {
			$where ["departid"] = array (
					"eq",
					"{$departid}" 
			);
			$hasdepartid = 1;
		}
		if (! empty ( $projectname )) {
			$where ["$projectname"] = array (
					"like",
					"%{$projectname}%" 
			);
			$hasdepartid = 1;
		}
		$where ['parentid'] = array (
				"exp",
				'IS NULL' 
		);
		$count = $Adminright->where ( $where )->count ();
		$page = $this->pagebar ( $count );
		$adminrights = $Adminright->page ( $page )->where ( $where )->field ( $Adminright->getTableName () . ".*, (select count(1) from " . $Adminright->getTableName () . " a where a.parentid=" . $Adminright->getTableName () . ".id ) as haschild,(select names from " . $Depart->getTableName () . " a where a.id=" . $Adminright->getTableName () . ".departid ) as departname " )->order ( 'id asc' )->select ();
		$returnarray = array ();
		foreach ( $adminrights as $key => $value ) {
			// 获取下级
			$Adminrighti = M ( 'Adminright' );
			$childs = $Adminrighti->where ( array (
					'parentid' => $value ['id'] 
			) )->field ( $Adminright->getTableName () . ".*, (select count(1) from " . $Adminright->getTableName () . " a where a.parentid=" . $Adminright->getTableName () . ".id ) as haschild,(select names from " . $Depart->getTableName () . " a where a.id=" . $Adminright->getTableName () . ".departid ) as departname " )->order ( 'id asc' )->select ();
			$row = array (
					'info' => $value,
					'childs' => $childs 
			);
			$returnarray [$key] = $row;
		}
		$this->assign ( 'adminrights', $returnarray );
		$this->assign ( 'hasclassid', $hasclassid );
		$this->assign ( 'hasdepartid', $hasdepartid );
		$this->assign ( 'departid', $departid );
		$this->assign ( 'classid', $classid );
		$this->display ();
	}
	/**
	 * 内容页
	 */
	public function detail() {
		$id = $_GET ['id'];
		$map ["id"] = array (
				"eq",
				$id 
		);
		$Adminright = M ( 'Adminright' );
		$objAdminright = $Adminright->join ( M ( 'Depart' )->getTableName () . " depart on depart.id=" . $Adminright->getTableName () . ".departid" )->where ( $Adminright->getTableName () . ".id=" . $id )->field ( $Adminright->getTableName () . ".*,depart.names as departname" )->find ();
		$this->assign ( 'adminright', $objAdminright );
		$this->display ();
	}
}

?>
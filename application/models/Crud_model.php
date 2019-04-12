<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Crud_model extends CI_Model
{

	function login($username, $password)
	{
		$username = $this->db->escape_str($username);
		$password = $this->db->escape_str($password);
		$password = sha1($password);
		$this->db->where('username',$username);
		$this->db->where('password',$password);
		$this->db->where('status','on');
		$this->db->limit(1);

		$query = $this->db->get('users');

		//echo $this->db->last_query();exit();
		//var_dump($query->result());exit();

		if($query->num_rows() > 0)
		{
			foreach ($query->result() as $row)
			{
				$data = array(
						'userid'=> $row->id,
						'name'=> $row->name,
						'username'=> $row->username,
						'type'=> $row->type,
						'filename'=> $row->filename,
						'logged_in'=>TRUE
					);
			}
			$this->db->where('userid',$data['userid']);
			$query = $this->db->get('users_access');
			if($query->num_rows() > 0)
			{
				foreach ($query->result() as $row)
				{
					$data[$row->module] = $row->status;
				}
			}

			/*$this->db->where('default','yes');
			$query = $this->db->get('language');
			//var_dump($query->result());exit();
			if($query->num_rows() > 0)
			{
				$data['default_lang_id'] = (int) $query->row(0)->id;
			}*/
			//var_dump($data);exit();

			$this->session->set_userdata($data);
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function record_count($table = '', $options = '')
	{
		if(!empty($table))
		{
			if(isset($options['groupby']))
			{

				$query = "SELECT COUNT(DISTINCT ".$options['groupby'].") AS numrows FROM $table";

				if( isset($options['where']) )
				{
					if( is_array($options['where']) )
					{
						foreach($options['where'] as $key => $value)
						{
							if( $key !== 0 )
								$options['where'][$key] = ' AND '.$value;
						}
						$where = implode("", $options['where']);
						$query .= " WHERE $where ";
					}
					else
						$query .= " WHERE ".$options['where'];
				}

				$query = $this->db->query($query);

				if(isset($options['debug']))
					echo $this->db->last_query();

				return (int) $query->row(0)->numrows;
			}
			else
			{
				if(isset($options['where']))
				{
					$options['where'] = explode('AND', $options['where']);
					foreach ($options['where'] as $value)
					{
						if( stristr($value, '=') )
						{
							$value = explode( '=', $value);
							$value[1] = trim(str_replace( array("'", '"'), '', $value[1]));
							$this->db->where($value[0], $value[1]);
						}
						/*else if( stristr($value, 'LIKE') )
						{
							$value = explode( '=', $value);
							$value[1] = str_replace( array("'", '"'), '', $value[1]);
							$this->db->like($value[1]);
						}*/
					}
					$query = $this->db->count_all_results($table);
				}
				else
					$query = $this->db->count_all($table);

				//pr($query);
				if(isset($options['debug']))
					echo $this->db->last_query();

				return $query;
			}
		}
		else
		{
			return msg_warning('The minimum requirement of Total Records not meet.');
		}
	}

    function get($options = array())
	{
		if(!isset($options['name']))
			$options['name'] = 'record';

		//var_dump($options);//exit();
		if(isset($options['join']))
		{
			if( !isset($options['fields']) or !isset($options['from']) )
				return msg_warning('The minimum requirement of join query is not fulfilled.');

			//var_dump($options);exit();
			$query = "SELECT ".$options['fields']." FROM ".$options['from'];

			if(isset($options['where']))
			{
				if( is_array($options['where']) )
				{
					foreach($options['where'] as $key => $value)
					{
						if( $key !== 0 )
							$options['where'][$key] = ' AND '.$value;
					}
					$where = implode("", $options['where']);
					$query .= " WHERE $where ";
				}
				else
					$query .= " WHERE ".$options['where'];
			}
		}
		else
		{
			if(isset($options['fields']))
				$query = "SELECT ".$options['fields']." FROM `".$options['table']."` ";
			else
				$query = "SELECT * FROM `".$options['table']."` ";

			if(isset($options['id']))
				$query .= "WHERE id = '".$options['id']."' ";
			else if(isset($options['parent_id']))
				$query .= "WHERE parent_id = ".$options['parent_id'];

			else if(isset($options['where']))
			{
				if( is_array($options['where']) )
				{
					foreach($options['where'] as $key => $value)
					{
						if( $key !== 0 )
							$options['where'][$key] = ' AND '.$value;
					}
					$where = implode("", $options['where']);
					$query .= " WHERE $where ";
				}
				else
					$query .= " WHERE ".$options['where'];
			}
		}

		if(isset($options['groupby']))
			$query .= " GROUP BY ".$options['groupby']." ";
		if(isset($options['orderby']))
			$query .= " ORDER BY ".$options['orderby']." ";
		if(isset($options['sortby']))
			$query .= " ".$options['sortby']."";

		if(isset($options['start']))
			$query .= " LIMIT ".$options['start'].", ".$options['limit']." ";
		else if(isset($options['limit']))
			$query .= " LIMIT ".$options['limit']." ";

		$query = $this->db->query($query);
//echo $this->db->last_query();
		if(isset($options['debug']))
		{
			write_to_file( log_data_path('sql_queries').'/get_'.date('Y-m-d').'.txt', $this->db->last_query() );
			//echo $this->db->last_query();
		}

		if($query->num_rows() > 0)
		{
			if(isset($options['id']))
			{
				return $query->row(0);
			}
			else
			{
				/*if( count($query->result()) == 1 )
				{
					return $query->row(0);
				}
				else
				{*/
					return $query->result();
				/*}*/
			}
		}
		else
		{
			return msg_warning('There is no '.$options['name'].' yet.');
		}
	}

	function add($options = array())
	{
		if(!isset($options['name']))
			$options['name'] = 'record';

		$query = $options['query'];
		if($this->db->query($query))
		{
			$_SESSION['last_inseted'] = $this->db->insert_id();
			return msg_success($options['name'].' added successfully.');
		}
		else
		{
			return msg_danger($this->db->last_query());
		}
	}

    function delete($options = array())
	{
		if(!isset($options['name']))
			$options['name'] = 'record';

		if(isset($options['userid']))
		{
			$query = 'DELETE FROM `'.$options['table'].'` WHERE `userid` = '.$options['userid'];
		}
		else if(isset($options['where']))
		{
			$query = 'DELETE FROM `'.$options['table'].'` WHERE '.$options['where'];
		}
		else
		{
			if(isset($options['keyword']))
			{
				$query = 'DELETE FROM `'.$options['table'].'` WHERE `keyword` = '.$options['keyword'];
			}
			else if(isset($options['groupid']))
			{
				$query = 'DELETE FROM `'.$options['table'].'` WHERE `groupid` = '.$options['groupid'];
			}
			else if(isset($options['listid']))
			{
				$query = 'DELETE FROM `'.$options['table'].'` WHERE `list_id` = '.$options['listid'];
			}
			else if(isset($options['channel_id']))
			{
				$query = 'DELETE FROM `'.$options['table'].'` WHERE `channel_id` = '.$options['channel_id'];
			}
			else
			{
				$query = 'DELETE FROM `'.$options['table'].'` WHERE `id` = '.$options['id'];
			}
		}

		if(isset($options['debug']))
			echo $this->db->last_query();

		if($this->db->query($query))
		{
			return msg_success($options['name'].' deleted successfully.');
		}
		else
		{
			return msg_danger($this->db->last_query());
		}
    }

    function query($options = array())
	{
		if( !isset($options['method']) )
			$options['method'] = '';

		if(!isset($options['name']))
			$options['name'] = 'record';

		$query = $this->db->query($options['query']);

			if(isset($options['debug']))
				echo $this->db->last_query();

		if($query)
		{
			if(isset($options['debug']))
				pr($query);

			if($options['method'] == 'get')
			{
				if($query->num_rows() > 0)
				{
					if(isset($options['id']))
					{
						return $query->row(0);
					}
					else
					{
						return $query->result();
					}
				}
			}
			else
			{
				if( isset($options['msg']) )
					return msg_success($options['msg']);
				else
					return msg_success($options['name'].' updated successfully.');
			}
		}
		else
		{
			return msg_danger($this->db->last_query());
		}
    }

	/*
	function query($options = array())
	{
		if(!isset($options['name']))
			$options['name'] = 'record';

		if($this->db->query($options['query']))
		{

			if(isset($options['debug']))
				echo $this->db->last_query();

			if( isset($options['msg']) )
				return msg_success($options['msg']);
			else
				return msg_success($options['name'].' updated successfully.');
		}
		else
		{
			return msg_danger($this->db->last_query());
		}
    }
    */

	function update($options = array())
	{
		if(!isset($options['name']))
			$options['name'] = 'record';

		$query = $options['query'];
		if($this->db->query($query))
		{
			if( isset($options['msg']) )
				return msg_success($options['msg']);
			else
				return msg_success($options['name'].' updated successfully.');
		}
		else
		{
			return msg_danger($this->db->last_query());
		}
	}

	function updateImages($options = array())
	{
		if(!isset($options['name']))
			$options['name'] = 'record';

		$query = $options['query'];
		if($this->db->query($query))
		{
			return msg_success($options['name'].' images updated successfully.');
		}
		else
		{
			return msg_danger($this->db->last_query());
		}
	}

    function deleteImage($options = array())
	{
		if(isset($options['field']))
		{
			if(isset($options['groupid']))
			{
				$query = "UPDATE `".$options['table']."` SET `".$options['field']."` = '' WHERE `groupid` = ".$options['groupid'];
			}
			else if(isset($options['id']))
			{
				$query = "UPDATE `".$options['table']."` SET `".$options['field']."` = '' WHERE `id` = ".$options['id'];
			}
			else
			{
				var_dump($options);exit();
			}

			if($this->db->query($query))
			{
				return msg_success('Image deleted successfully.');
			}
			else
			{
				return msg_danger($this->db->last_query());
			}
		}
		else
			return msg_warning('Something went wrong.');
    }

	function finalizeSlug($options = array())
	{

		$query = "SELECT slug FROM `".$options['table']."` WHERE slug = '".$options['slug']."'";

		if(isset($options['id']))
		{
			$query .= "AND id != ".$options['id'];
		}

		$query = $this->db->query($query);
		//echo $this->db->last_query();exit();
		if($query->num_rows() > 0)
		{
			return $options['slug'].'-'.randomStrNum(4);
		}
		else
		{
			return $options['slug'];
		}

	}

	function finalizeInsertUpdate($options = array())
	{
		if( !isset($options['table']) or empty($options['table']) )
			return 'table name is required';

		if( !isset($options['value']) or empty($options['value']) )
			return 'value of field is required';

		$field = isset($options['field']) ? $options['field'] : 'slug';
		$query = "SELECT $field FROM `".$options['table']."` WHERE $field = '".$options['value']."'";


		$query = $this->db->query($query);
		//echo $this->db->last_query();exit();
		if($query->num_rows() > 0)
		{
			return 'do_update';
		}
		else
		{
			return 'do_insert';
		}

	}


}
<?php

namespace Pingpong\Admin;

use DB, Form, Request;
use Closure;
use Pingpong\Admin\AdminException as Exception;

class Resource
{
	public function selectFields($table, $fields = '*')
	{
		if($fields == '*') return $table.'.*';
		
		$result = array();
		$data = DB::select("SHOW columns FROM $table");
		foreach ($datas as $data) {
			$result[] = $table.'.'.$data->Field;
		}
		return $result;
	}

	public function getFields($table, $fields = '*')
	{	
		$result = array();
		$datas = DB::select("SHOW columns FROM $table");
		foreach ($datas as $key => $data) {
			$field = $data->Field;
			
			if(is_string($fields) AND $fields == '*')
			{
				$result[] = $field;
			}elseif(is_array($fields))
			{
				if(in_array($field, $fields))
				{
					$result[] = $field;
				}
			}else{
				throw new Exception("Fields value must be an array or string (*).");
			}
		}
		return $result;
	}

	public function heading($fields, $allows)
	{
		$result = '';
		foreach ($fields as $field) {
			if(isset($allows[$field]))
			{
				$allow = $allows[$field];
				if(is_array($allow))
				{
					$result.= '<th>'. $allow[0] .'</th>';
				}elseif(is_string($allow))
				{
					$result.= '<th>'. $allow .'</th>';
				}else
				{
					throw new Exception("Format field must be an array or string.");
				}
			}else{
				$result.= '<th>'.$field.'</th>';
			}
		}
		$result.= '<th width="10%"><div class="text-center">Action</div></th>';
		return $result;		
	}

	public function fetch($data, $fields, $formatArray)
	{
		$result = '<tr>';
		foreach ($fields as $field) {
			$result.= '<td>';
			if(isset($data->$field))
			{

				if( ! isset($formatArray[$field]))
				{
					$result.= $data->$field;
				}else{
					$format = $formatArray[$field];
					if(is_string($format))
					{
						if(isset($data->$field))
						{
							$result.= $data->$field;
						}
					}else{
						$params 	= [$data->$field];
						$callback 	= $format[1];
						$result.= call_user_func_array($callback, $params);
					}
				}
			}
			$result.= '</td>';

		}

		$url_edit = url('admin/'.Request::segment(2).'/'.$data->id.'/edit');
		$url_show = url('admin/'.Request::segment(2).'/'.$data->id);

		$result.= '<td class="td-action"><div class="text-center">';
		$result.= '
			<div class="btn-group">
				<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
					Action
					<span class="caret"></span>
				</button>
				<ul class="dropdown-menu text-left pull-right" role="menu">
					<li>
						<a href="'.$url_show.'">
							<i class="glyphicon glyphicon-list-alt"></i>
							Detail
						</a>
					</li>
					<li>
						<a href="'.$url_edit.'">
							<i class="glyphicon glyphicon-edit"></i>
							Edit
						</a>
					</li>
					<li>
						<a class="btn-form-delete" data-form-id="#form'.$data->id.'" href="#">
							<i class="glyphicon glyphicon-trash"></i>
							Delete
						</a>
					</li>
				</ul>
			</div><!-- /btn-group -->
		';
		$result.= Form::open(array('id'=>'form'.$data->id, 'method'=> 'DELETE', 'url'=> 'admin/'.Request::segment(2).'/'.$data->id));
		$result.= Form::close();
		$result.= '</div></td>';
		$result.= '</tr>';
		return $result;
	}

	public function form($name, $options)
	{
		if($options instanceof Closure)
		{
			return call_user_func($options);
		}else{
			$type = $options['type'];
			switch ($type) {
				case 'text':
					return Form::text($name, $options['value'], $options['attributes']);
					break;
				
				case 'textarea':
					return Form::textarea($name, $options['value'], $options['attributes']);
					break;

				case 'number':
				case 'phone':
				case 'checkbox':
				case 'radio':
				case 'email':
				case 'password':
					return Form::input($type, $name, $options['value'], $options['attributes']);
					break;
				
				case 'select':
					return Form::select($name, $options['options'], $options['value'], $options['attributes']);
					break;
				
				
				default:
					return 'Unknow form type '.$type;
					break;
			}
		}
	}
}
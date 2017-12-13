<?php

/**
* @author zhzhussupovkz@gmail.com
* @copyright (c) 2014 Zhussupov Zhassulan zhzhussupovkz@gmail.com
*/
class PHPechkin {

	//login for auth
	private $username;

	//password for auth
	private $password;

	//pechkin mail api url
	private $apiUrl = 'https://api.pechkin-mail.ru/';

	//check email
	private $checkUrl = 'http://pechkinfix.ru/check.php';

	//constructor
	public function __construct($username = null, $password = null) {
		if (!$username || !$password)
			return $this->getError('100');
		$this->username = $username;
		$this->password = $password;
	}

	//get error codes
	private function getError($key) {
		$errors = array(
			'2' => '������ ��� ���������� � ����',
			'3' => '������ �� ��� ����������� ���������',
			'4' => '��� ������ ��� ������',
			'5' => '� ������������ ��� �������� ���� � ����� id',
			'6' => '������������ email-�����',
			'7' => '����� ������������ ��� ���� � ���� �������� ����',
			'8' => '����� �� ���������� �������� ����������� �� �������� ����� �������',
			'9' => '��� ������ ���������� � �������',
			'10' => '������������ ��� �������',
			'11' => '��� ������ ��� ���������� ����������',
			'12' => '�� ������ �������� ������',
			'13' => '�� ������ ����� ��������',
			'14' => '�� ����� ��������� ������',
			'15' => '�� ������ ���� �� ����?',
			'16' => '�� ����� �������� �����',
			'17' => '�� ������ �� html �� plain_text ������ ������',
			'18' => '��� ������ ���������� � ������ ��������. ������ ������: ����������',
			'19' => '��� ������ ���������� � ������ ��������',
			'20' => '����� ������������ ������ ��������',
			'21' => '�������� ��� ������������',
			'22' => '� ��� ��� �������� � ����� campaign_id',
			'23' => '��� ������ ���� ��� ����������',
			'24' => '������ ������������ ������� ��� ������������',
			'25' => '����������� ���� ��� ����������',
			'26' => '����������� ���� ������ 5 ��',
			'27' => '���� �� ������',
			'28' => '��������� ������ �� ����������',
			'100' => '�������� ������ ��� ����������� API',
			'101' => '�������������� ����� API ��� ������ ������������ ����� API',
		);
		return $errors[$key];
	}

	//get data by method
	public function getData($method = null, $params = array()) {
		if (!is_string($method))
			return $this->getError('101');
		$user = array('username' => $this->username, 'password' => $this->password);
		$params = array_merge($user, $params);
		$params = http_build_query($params);

		$url = $this->apiUrl.'?method='.$method.'&'.$params.'&format=xml';

		$options = array(
			CURLOPT_URL => $url,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_SSL_VERIFYPEER => 0,
		);
		$ch = curl_init();
		curl_setopt_array($ch, $options);
		$result = curl_exec($ch);
		if ($result == false)
			throw new Exception(curl_error($ch));
		curl_close($ch);

		$xml = simplexml_load_string($result);
		$json = json_encode($xml);
		$final = json_decode($json, TRUE);
		if (!$final)
			throw new Exception('�������� �������� ������, ����������, ���������, ��� ������������� ����� API ����������');
		if ($final['msg']['err_code'] == '0') {
			return $final['data'];
		} else {
			return $this->getError($final['msg']['err_code']);
		}
	}

	//send post data
	private function sendData($method = null, $params) {

		if (!is_string($method))
			return $this->getError('101');
		$user = array('username' => $this->username, 'password' => $this->password, 'format' => 'xml');
		$params = array_merge($user, $params);

		$options = array(
			CURLOPT_URL => $this->apiUrl.'?method='.$method,
			CURLOPT_POST => true,
			CURLOPT_POSTFIELDS => $params,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_SSL_VERIFYPEER => 0,
			);

		$ch = curl_init();
		curl_setopt_array($ch, $options);
		$result = curl_exec($ch);
		if ($result == false)
			throw new Exception(curl_error($ch));
		curl_close($ch);
		$xml = simplexml_load_string($result);
		$json = json_encode($xml);
		$final = json_decode($json, TRUE);
		if (!$final)
			throw new Exception('�������� �������� ������, ����������, ���������, ��� ������������� ����� API ����������');
		if ($final['msg']['err_code'] == '0') {
			return $final['data'];
		} else {
			return $this->getError($final['msg']['err_code']);
		}
	}

	//check email address
	public function checkEmail($email) {
		$checking = $this->checkUrl.'?email='.$email.'&format=xml';
		$result = file_get_contents($checking);
		$xml = simplexml_load_string($result);
		$json = json_encode($xml);
		$final = json_decode($json, TRUE);
		if (!$final)
			throw new Exception('��� �������� email �������� �������� ������');
		$err = $final['err_code'];
		if ($err == '0' || $err == '1') {
			return $final['text'];
		} else {
			return false;
		}
	}


	/*****************************************************************
	**************** ������ � ��������� ������ ***********************
	******************************************************************/
	//lists.get - �������� ������ ��� ������������
	/*
	optional: list_id
	*/
	public function lists_get($list_id = '') {
		if (!empty($list_id))
			$params = array('list_id' => $list_id);
		else
			$params = array();
		return $this->getData('lists.get', $params);
	}

	//lists.add - ��������� �������� ����
	/*
	required: name
	optional: abuse_email, abuse_name, company...
	http://pechkin-mail.ru/?page=api_details&method=lists.add
	*/
	public function lists_add($name = null, $params = array()) {
		if (!is_null($name))
			$required = array('name' => $name);
		else
			return $this->getError('3');
		if (isset($params['abuse_email'])) {
			$email = $this->checkEmail($params['abuse_email']);
			if ($email !== false)
				$params['abuse_email'] = $email;
			else
				return $this->getError('6');
		}
		$params = array_merge($required, $params);
		return $this->sendData('lists.add', $params);
	}

	//lists.update - ��������� ���������� ���������� �������� ����
	/*
	required: list_id
	optional: name, abuse_email, abuse_name, company...
	see: http://pechkin-mail.ru/?page=api_details&method=lists.update
	*/
	public function lists_update($list_id = null, $params = array()) {
		if (!is_null($list_id))
			$list_id = array('list_id' => $list_id);
		else
			return $this->getError('3');
		if (isset($params['abuse_email'])) {
			$email = $this->checkEmail($params['abuse_email']);
			if ($email !== false)
				$params['abuse_email'] = $email;
			else
				return $this->getError('6');
		}
		$params = array_merge($list_id, $params);
		return $this->sendData('lists.update', $params);
	}

	//lists.delete - ������� �������� ���� � ���� �������� ����������� � ���.
	/*
	required: list_id
	*/
	public function lists_delete($list_id = null) {
		if (!is_null($list_id))
			$params = array('list_id' => $list_id);
		else
			return $this->getError('3');
		return $this->sendData('lists.delete', $params);
	}

	//lists.get_members - �������� ����������� � �������� ���� � ����������� ������� � ����������� ������.
	/*
	required: list_id
	optional: state, start, limit...
	see: http://pechkin-mail.ru/?page=api_details&method=lists.get_members
	*/
	public function lists_get_members($list_id = null, $params = array()) {
		if (!is_null($list_id))
			$required = array('list_id' => $list_id);
		else
			return $this->getError('3');
		$params = array_merge($required, $params);
		return $this->getData('lists.get_members', $params);
	}

	//lists.upload - ������ ����������� �� �����
	/*
	required: list_id, file, email
	optional: merge_1, merge_2, type, update...
	see: http://pechkin-mail.ru/?page=api_details&method=lists.upload
	*/
	public function lists_upload($list_id = null, $file = null, $email = null, $params = array()) {
		if (is_null($list_id) || is_null($email) || is_null($file))
			return $this->getError('3');
		if ($email !== false)
			$required = array('list_id' => $list_id, 'file' => $file, 'email' => $email);
		else
			return $this->getError('6');
		$params = array_merge($required, $params);
		return $this->sendData('lists.upload', $params);
	}

	//lists.add_member - ��������� ���������� � ����
	/*
	required: list_id, email
	optional: merge_1, merge_2..., update...
	see: http://pechkin-mail.ru/?page=api_details&method=lists.add_member
	*/
	public function lists_add_member($list_id = null, $email = null, $params = array()) {
		if (is_null($list_id) || is_null($email))
			return $this->getError('3');
		$email = $this->checkEmail($email);
		if ($email !== false)
			$required = array('list_id' => $list_id, 'email' => $email);
		else
			return $this->getError('6');
		$params = array_merge($required, $params);
		return $this->sendData('lists.add_member', $params);
	}

	//lists.update_member - ����������� ���������� � ����
	/*
	required: member_id
	optional: merge_1, merge_2...
	see: http://pechkin-mail.ru/?page=api_details&method=lists.update_member
	*/
	public function lists_update_member($member_id = null, $params = array()) {
		if (!is_null($member_id))
			$required = array('member_id' => $member_id);
		else
			return $this->getError('3');
		$params = array_merge($required, $params);
		return $this->sendData('lists.update_member', $params);
	}

	//lists.delete_member - ������� ���������� �� ����
	/*
	required: member_id
	*/
	public function lists_delete_member($member_id = null) {
		if (!is_null($member_id))
			$params = array('member_id' => $member_id);
		else
			return $this->getError('3');
		return $this->sendData('lists.delete_member', $params);
	}

	//lists.unsubscribe_member - ����������� ���������� � ����
	/*
	optional: member_id, email, list_id
	see: http://pechkin-mail.ru/?page=api_details&method=lists.unsubscribe_member
	*/
	public function lists_unsubscribe_member($params = array()) {
		if (isset($params['email'])) {
			$email = $this->checkEmail($params['email']);
			if ($email !== false)
				$params['email'] = $email;
			else
				return $this->getError('6');
		}
		return $this->sendData('lists.unsubscribe_member', $params);
	}

	//lists.move_member - ���������� ���������� � ������ �������� ����.
	/*
	required: member_id, list_id
	*/
	public function lists_move_member($member_id = null, $list_id = null) {
		if (is_null($member_id) || is_null($list_id))
			return $this->getError('3');
		$params = array('member_id' => $member_id, 'list_id' => $list_id);
		return $this->sendData('lists.move_member', $params);
	}

	//lists.copy_member - �������� ���������� � ������ �������� ����
	/*
	required: member_id, list_id
	*/
	public function lists_copy_member($member_id = null, $list_id = null) {
		if (is_null($member_id) || is_null($list_id))
			return $this->getError('3');
		$params = array('member_id' => $member_id, 'list_id' => $list_id);
		return $this->sendData('lists.copy_member', $params);
	}

	//lists.add_merge - �������� �������������� ���� � �������� ����
	/*
	required: list_id, type
	optional: choises, title, ...
	see: http://pechkin-mail.ru/?page=api_details&method=lists.add_merge
	*/
	public function lists_add_merge($list_id = null, $type = null, $params = array()) {
		if (is_null($list_id) || is_null($type))
			return $this->getError('3');
		$required = array('list_id' => $list_id, 'type' => $type);
		$params = array_merge($required, $params);
		return $this->sendData('lists.add_merge', $params);
	}

	//lists.update_merge - �������� ��������� ��������������� ���� � �������� ����
	/*
	required: list_id, merge_id
	optional: choisesm title, ...
	see: http://pechkin-mail.ru/?page=api_details&method=lists.update_merge
	*/
	public function lists_update_merge($list_id = null, $merge_id = null, $params = array()) {
		if (is_null($merge_id) || is_null($list_id))
			return $this->getError('3');
		$required = array('list_id' => $list_id, 'merge_id' => $merge_id);
		$params = array_merge($required, $params);
		return $this->sendData('lists.update_merge', $params);
	}

	//lists.delete_merge - ������� �������������� ���� �� �������� ����
	/*
	required: list_id, merge_id
	see: http://pechkin-mail.ru/?page=api_details&method=lists.delete_merge
	*/
	public function lists_delete_merge($list_id = null, $merge_id = null) {
		if (is_null($merge_id) || is_null($list_id))
			return $this->getError('3');
		$params = array('list_id' => $list_id, 'merge_id' => $merge_id);
		return $this->sendData('lists.delete_merge', $params);
	}


	/*******************************************************************
	************************* ������ � ���������� **********************
	********************************************************************/
	//campaigns.get - �������� ������ �������� ������������
	/*
	optional: campaign_id, status, list_id, type
	see: http://pechkin-mail.ru/?page=api_details&method=campaigns.get
	*/
	public function campaigns_get($params = array()) {
		return $this->getData('campaigns.get', $params);
	}

	//campaigns.create - ������� ��������
	/*
	required: list_id
	optional: name, subject, ...
	see: http://pechkin-mail.ru/?page=api_details&method=campaigns.create
	*/
	public function campaigns_create($list_id = null, $params = array()) {
		if (!is_array($list_id))
			return $this->getError('3');
		$list_id = serialize($list_id);
		$required = array('list_id' => $list_id);
		$params = array_merge($required, $params);
		return $this->sendData('campaigns.create', $params);
	}

	//campaigns.create_auto - ������� ������������
	/*
	optional: list_id, name, subject
	see: http://pechkin-mail.ru/?page=api_details&method=campaigns.create_auto
	*/
	public function campaigns_create_auto($params = array()) {
		$params['list_id'] = serialize($params['list_id']);
		return $this->sendData('campaigns.create_auto', $params);
	}

	//campaigns.update - ��������� ��������� ��������
	/*
	required: campaign_id
	optional: list_id, name, subject, ...
	see: http://pechkin-mail.ru/?page=api_details&method=campaigns.update
	*/
	public function campaigns_update($campaign_id = null, $params = array()) {
		if (is_null($campaign_id))
			return $this->getError('3');
		$required = array('campaign_id' => $campaign_id);
		if (isset($params['list_id']))
			$params['list_id'] = serialize($params['list_id']);
		$params = array_merge($required, $params);
		return $this->sendData('campaigns.update', $params);
	}

	//campaigns.update_auto - ��������� ��������� ������������
	/*
	required: campaign_id
	optional: list_id, name, subject, ...
	see: http://pechkin-mail.ru/?page=api_details&method=campaigns.update_auto
	*/
	public function campaigns_update_auto($campaign_id = null, $params = array()) {
		if (is_null($campaign_id))
			return $this->getError('3');
		$required = array('campaign_id' => $campaign_id);
		$params['list_id'] = serialize($params['list_id']);
		$params = array_merge($required, $params);
		return $this->sendData('campaigns.update_auto', $params);
	}

	//campaigns.delete - ������� ��������
	/*
	required: campaign_id
	see: http://pechkin-mail.ru/?page=api_details&method=campaigns.delete
	*/
	public function campaigns_delete($campaign_id = null) {
		if (is_null($campaign_id))
			return $this->getError('3');
		$params = array('campaign_id' => $campaign_id);
		return $this->sendData('campaigns.delete', $params);
	}

	//campaigns.attach - ����������� ����
	/*
	required: campaign_id, url
	optional: name
	see: http://pechkin-mail.ru/?page=api_details&method=campaigns.attach
	*/
	public function campaigns_attach($campaign_id = null, $url = null, $params = array()) {
		if (is_null($campaign_id) || is_null($url))
			return $this->getError('3');
		$required = array('campaign_id' => $campaign_id, 'url' => $url);
		$params = array_merge($required, $params);
		return $this->sendData('campaigns.attach', $params);
	}

	//campaigns.get_attachments - �������� ����������� �����
	/*
	required: campaign_id
	see: http://pechkin-mail.ru/?page=api_details&method=campaigns.get_attachments
	*/
	public function campaigns_get_attachments($campaign_id = null, $params = array()) {
		if (is_null($campaign_id))
			return $this->getError('3');
		$required = array('campaign_id' => $campaign_id);
		$params = array_merge($required, $params);
		return $this->getData('campaigns.get_attachments', $params);
	}

	//campaigns.delete_attachments - ������� ����������� ����
	/*
	required: campaign_id, id
	see: http://pechkin-mail.ru/?page=api_details&method=campaigns.delete_attachments
	*/
	public function campaigns_delete_attachments($campaign_id = null, $id = null, $params = array()) {
		if (is_null($campaign_id) || is_null($id))
			return $this->getError('3');
		$required = array('campaign_id' => $campaign_id, 'id' => $id);
		$params = array_merge($required, $params);
		return $this->sendData('campaigns.delete_attachments', $params);
	}

	//campaigns.get_templates - �������� html �������
	/*
	optional: name, id
	see: http://pechkin-mail.ru/?page=api_details&method=campaigns.get_templates
	*/
	public function campaigns_get_templates($params = array()) {
		return $this->getData('campaigns.get_templates', $params);
	}

	//campaigns.add_template - ��������� html ������
	/*
	required: name, template
	see: http://pechkin-mail.ru/?page=api_details&method=campaigns.add_template
	*/
	public function campaigns_add_template($name = null, $template = null) {
		if (is_null($name) || is_null($template))
			return $this->getError('3');
		$params = array('name' => $name, 'template' => $template);
		return $this->sendData('campaigns.add_template', $params);
	}

	//campaigns.delete_template - ������� html ������
	/*
	required: id
	*/
	public function campaigns_delete_template($id = null) {
		if (is_null($id))
			return $this->getError('3');
		$params = array('id' => $id);
		return $this->sendData('campaigns.delete_templates', $params);
	}

	//campaigns.force_auto - ������������� �������� ������������ ������������ (��� ���� ��� ������ ���� �������)
	/*
	required: campaign_id, email
	optional: delay
	see: http://pechkin-mail.ru/?page=api_details&method=campaigns.force_auto
	*/
	public function campaigns_force_auto($campaign_id = null, $email = null, $params = array()) {
		if (is_null($campaign_id) || is_null($email))
			return $this->getError('3');
		$email = $this->checkEmail($email);
		if ($email !== false)
			$required = array('campaign_id' => $campaign_id, 'email' => $email);
		else
			return $this->getError('6');
		$params = array_merge($required, $params);
		return $this->sendData('campaigns.force_auto', $params);
	}

	/***************************************************************
	********************* ������ � �������� ************************
	****************************************************************/
	//reports.send - ������ ������������ ����� � ��������
	/*
	required: campaign_id
	optional: start, limit, order
	see: http://pechkin-mail.ru/?page=api_details&method=reports.send
	*/
	public function reports_sent($campaign_id = null, $params = array()) {
		if (is_null($campaign_id))
			return $this->getError('3');
		$required = array('campaign_id' => $campaign_id);
		$params = array_merge($required, $params);
		return $this->sendData('reports.sent', $params);
	}

	//reports.delivered - ������ ������������ ����� � ��������
	/*
	required: campaign_id
	optional: start, limit, order
	see: http://pechkin-mail.ru/?page=api_details&method=reports.delivered
	*/
	public function reports_delivered($campaign_id = null, $params = array()) {
		if (is_null($campaign_id))
			return $this->getError('3');
		$required = array('campaign_id' => $campaign_id);
		$params = array_merge($required, $params);
		return $this->getData('reports.delivered', $params);
	}

	//reports.opened - ������ �������� ����� � ��������
	/*
	required: campaign_id
	optional: start, limit, order
	see: http://pechkin-mail.ru/?page=api_details&method=reports.opened
	*/
	public function reports_opened($campaign_id = null, $params = array()) {
		if (is_null($campaign_id))
			return $this->getError('3');
		$required = array('campaign_id' => $campaign_id);
		$params = array_merge($required, $params);
		return $this->getData('reports.opened', $params);
	}

	//reports.unsubscribed - ������ ����� ������������ ����������� � ��������
	/*
	required: campaign_id
	optional: start, limit, order
	see: http://pechkin-mail.ru/?page=api_details&method=reports.unsubscribed
	*/
	public function reports_unsubscribed($campaign_id = null, $params = array()) {
		if (is_null($campaign_id))
			return $this->getError('3');
		$required = array('campaign_id' => $campaign_id);
		$params = array_merge($required, $params);
		return $this->getData('reports.unsubscribed', $params);
	}

	//reports.bounced - ������ �������������� ����� � ��������
	/*
	required: campaign_id
	optional: start, limit, order
	see: http://pechkin-mail.ru/?page=api_details&method=reports.bounced
	*/
	public function reports_bounced($campaign_id = null, $params = array()) {
		if (is_null($campaign_id))
			return $this->getError('3');
		$required = array('campaign_id' => $campaign_id);
		$params = array_merge($required, $params);
		return $this->getData('reports.unsubscribed', $params);
	}

	//reports.clickstat - C��������� �� ������ �� ��������� url � ������
	/*
	required: campaign_id
	see: http://pechkin-mail.ru/?page=api_details&method=reports.clickstat
	*/
	public function reports_clickstat($campaign_id = null) {
		if (is_null($campaign_id))
			return $this->getError('3');
		$params = array('campaign_id' => $campaign_id);
		return $this->getData('reports.clickstat', $params);
	}

	//reports.bouncestat - C��������� �� ������������ �������� �������� ������
	/*
	required: campaign_id
	see: http://pechkin-mail.ru/?page=api_details&method=reports.bouncestat
	*/
	public function reports_bouncestat($campaign_id = null) {
		if (is_null($campaign_id))
			return $this->getError('3');
		$params = array('campaign_id' => $campaign_id);
		return $this->getData('reports.bouncestat', $params);
	}

	//reports.summary - ������� ���������� �� ��������
	/*
	required: campaign_id
	see: http://pechkin-mail.ru/?page=api_details&method=reports.summary
	*/
	public function reports_summary($campaign_id = null) {
		if (is_null($campaign_id))
			return $this->getError('3');
		$params = array('campaign_id' => $campaign_id);
		return $this->getData('reports.summary', $params);
	}

	//reports.clients - C��������� �� ���������, �� � �������� ��������
	/*
	required: campaign_id
	see: http://pechkin-mail.ru/?page=api_details&method=reports.clients
	*/
	public function reports_clients($campaign_id = null) {
		if (is_null($campaign_id))
			return $this->getError('3');
		$params = array('campaign_id' => $campaign_id);
		return $this->getData('reports.clients', $params);
	}

	//reports.geo - C��������� �� �������� ��������
	/*
	required: campaign_id
	see: http://pechkin-mail.ru/?page=api_details&method=reports.geo
	*/
	public function reports_geo($campaign_id = null) {
		if (is_null($campaign_id))
			return $this->getError('3');
		$params = array('campaign_id' => $campaign_id);
		return $this->getData('reports.geo', $params);
	}

}
<?

class PHPShopCron {

    function PHPShopCron() {
        global $PHPShopSystem;
        $this->PHPShopSystem=$PHPShopSystem;
        $this->SysValue=$GLOBALS['SysValue'];
        $this->date=date("U");
        $this->debug=false;

        // ���������
        $this->job();
    }


    // ���������
    function job() {
        $PHPShopOrm= new PHPShopOrm($this->SysValue['base']['cron']['cron_job']);
        $PHPShopOrm->debug=$this->debug;
        $this->job=$PHPShopOrm->select(array('*'),false,array('order'=>'id'),array('limit'=>100));
    }


    // ���������� ������
    function execute($job) {
        
        if(is_file($job['path'])) {
            if (fopen("http://".$_SERVER['SERVER_NAME']."/".$job['path'],"r")) return '���������';
            else return '������ ������ ����';
        }
        else return '������ ���������� �����';
    }


    // ������
    function start() {
        if(is_array( $this->job))

            foreach($this->job as $key=>$job) {
                if($job['enabled'] and empty($job['used'])) {
                    if($this->date-$job['last_execute']>(86400/$job['execute_day_num'])) {
                        // ����� ���
                        $this->log($job,'start');

                        // ���������� ������
                        $job['status']=$this->execute($job);

                        // ����� ���
                        $this->log($job,'end');
                    }
                }
            }
    }



    // ������ ���� � ����
    function log($job,$action) {

        switch($action) {

            case "start":

                // ��������� ��������
                $PHPShopOrm= new PHPShopOrm($this->SysValue['base']['cron']['cron_job']);
                $PHPShopOrm->debug=$this->debug;
                $PHPShopOrm->update(array('used_new'=>'1'),array('id'=>'='.$job['id']));

                // ����� ���
                $PHPShopOrm= new PHPShopOrm($this->SysValue['base']['cron']['cron_log']);
                $PHPShopOrm->debug=$this->debug;
                $PHPShopOrm->insert(array('date_new'=>$this->date,'name_new'=>$job['name'],'path_new'=>$job['path'],
                    'job_id_new'=>$job['id']));
                $this->log_id=mysql_insert_id();
                break;

            case "end":

                $PHPShopOrm= new PHPShopOrm($this->SysValue['base']['cron']['cron_log']);
                $PHPShopOrm->debug=$this->debug;
                $PHPShopOrm->update(array('status_new'=>$job['status']),array('id'=>'='.$this->log_id));

                // ������� ���������� ��������
                $PHPShopOrm= new PHPShopOrm($this->SysValue['base']['cron']['cron_job']);
                $PHPShopOrm->debug=$this->debug;
                $PHPShopOrm->update(array('used_new'=>'0','last_execute_new'=>$this->date),array('id'=>'='.$job['id']));

                break;
        }
    }
}

?>
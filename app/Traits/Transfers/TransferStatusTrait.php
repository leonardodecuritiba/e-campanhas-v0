<?php

namespace App\Traits\Transfers;



trait TransferStatusTrait {

	static $_STATUS_OPPENED_ = 0;
	static $_STATUS_INPROGRESS_ = 1;
	static $_STATUS_INTRANSFER_TO_HUB_ = 2;
	static $_STATUS_INCONFERENCE_ = 3;
	static $_STATUS_CLOSED_ = 4;


    public function getStatusArrayAttribute()
    {
        return [
            'text'  => $this->getStatusTextAttribute(),
            'color' => $this->getStatusColorAttribute(),
        ];
    }

	static public function getAlltoSelectList()
    {
        foreach(range(0, 4) as $i){
            $array[$i] = self::getStatusText($i);
        }
        return $array;
	}

	public function getStatusIconAttribute() {
		switch($this->getAttribute('status_id')){
			case self::$_STATUS_OPPENED_:
				return 'access_time';
			case self::$_STATUS_INPROGRESS_:
				return 'compare_arrows';
			case self::$_STATUS_INTRANSFER_TO_HUB_:
				return 'local_shipping';
			case self::$_STATUS_INCONFERENCE_:
				return 'playlist_add_check';
			case self::$_STATUS_CLOSED_:
				return 'check';
			default:
				return 'check';
		}
    }

    public function getStatusTextAttribute($status_id = NULL)
    {
        $status_id = ($status_id == NULL) ? $this->getAttribute('status_id') : $status_id;
        return self::getStatusText($status_id);
    }

    static public function getStatusText($status_id)
    {
        switch($status_id){
            case self::$_STATUS_OPPENED_:
                return 'EM ABERTO';
            case self::$_STATUS_INPROGRESS_:
                return 'EM ANDAMENTO';
            case self::$_STATUS_INTRANSFER_TO_HUB_:
                return 'EM TRÂNSITO PARA HUB';
            case self::$_STATUS_INCONFERENCE_:
                return 'EM CONFERÊNCIA';
            case self::$_STATUS_CLOSED_:
                return 'FINALIZADO';
            default:
                return 'NÃO IDENTIFICADO';
        }
    }

	public function getStatusColorAttribute() {
		switch($this->getAttribute('status_id')){
            case self::$_STATUS_OPPENED_:
                return 'info';
            case self::$_STATUS_INPROGRESS_:
                return 'yellow';
            case self::$_STATUS_INTRANSFER_TO_HUB_:
                return 'purple';
            case self::$_STATUS_INCONFERENCE_:
                return 'warning';
            case self::$_STATUS_CLOSED_:
                return 'success';
			default:
				return 'NÃO IDENTIFICADO';
		}
    }


	public function sended()
	{
		return ($this->attributes['driver_mail_at'] != NULL);
	}
}
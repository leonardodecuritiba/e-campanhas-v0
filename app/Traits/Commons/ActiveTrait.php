<?php

namespace App\Traits\Commons;


use Illuminate\Database\Eloquent\Builder;

trait ActiveTrait {

    public function updateActive()
    {
        $new = ! $this->attributes['status'];
        $this->status = $new;
        $this->save();
        $message = $new ? trans( 'messages.activate', [ 'name' => $this->getShortName() ] ) : trans( 'messages.inactivate', [ 'name' => $this->getShortName() ] );
        return $this->getActiveFullResponse( $message );
    }

    public function getActiveFullResponse( $message = null )
    {
        return [
            'id'               => $this->getAttribute('id'),
            'model'            => get_class($this),
            'message'          => $message,
            'value'            => $this->attributes['status'],
            'active_text'      => $this->getActiveText(),
            'active_color'     => $this->getActiveColor(),
            'active_row_color' => $this->getActiveRowColor(),
            'active_btn_color' => $this->getActiveBtnColor(),
            'active_btn_icon'  => $this->getActiveBtnIcon(),
            'active_btn_text'  => $this->getActiveBtnText(),
            'active_update_message'  => $this->getActiveUpdateMessage(),
        ];
    }

    public function getActiveText()
    {
        return ( $this->attributes['status'] ) ? 'Ativo' : 'Inativo';
    }

    public function getActiveColor()
    {
        return ( $this->attributes['status'] ) ? 'success' : 'danger';
    }

    public function getActiveRowColor()
    {
        return ( $this->attributes['status'] ) ? '' : 'bg-pale-danger';
    }

    public function getActiveBtnColor()
    {
        return ( $this->attributes['status'] ) ? 'default' : 'success';
    }

    public function getActiveBtnIcon()
    {
        return ( $this->attributes['status'] ) ? 'ti-na' : 'ti-check-box';
    }

    public function getActiveBtnText()
    {
        return ( $this->attributes['status'] ) ? 'Desativar' : 'Ativar';
    }

    public function getActiveUpdateMessage()
    {
        return $this->getShortName() . (( $this->attributes['status'] ) ? ' ativado com sucesso!' : ' desativado com sucesso!');
    }

    /**
     * Scope a query to only include active.
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    /**
     * Scope a query to only include inactive.
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeInactive($query)
    {
        return $query->where('status', 0);
    }

}
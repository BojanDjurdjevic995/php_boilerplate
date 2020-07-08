<?php
namespace App\Traits;

trait ArrayHelper
{
    public static function buildSenders($value)
    {
        if(isset($value->sender) && isset($value->senderID))
        {
            $sender = '<div class="d-flex sendersRemoveDivs justify-content-between align-items-center">' . $value->sender . '<form class="formAdd" method="post" action="">';
            $sender .= '<input type="hidden" name="id" value="'.$value->senderID.'">';
            $sender .= '<button class="btn btn-danger btnDangerWhite buttonPading buttonX trash"><i class="fa fa-trash"></i></button>';
            $sender .= '<button type="button" 
                                class="btn btn-primary buttonPading btnPrimaryColor buttonForRemove ml-3" 
                                onclick="senderOption(\''.$value->country.'\')" 
                                data-toggle="modal" 
                                data-target="#addSenders">
                            <i class="fa fa-close plusButton"></i></button></form></div>';
        }
        else
            $sender = '<div class="d-flex justify-content-end">
                         <button class="btn btn-primary buttonPading buttonForRemoveAlone btnPrimaryColor ml-3 " onclick="senderOption(\''.$value->country.'\')" data-toggle="modal" data-target="#addSenders">
                            <i class="fa fa-close plusButton"></i></button></div>';
        return $sender;
    }

    public static function buildTemplates($value)
    {
        $templates = TemplateLang::select('template_langs.country, template_langs.sender')
                                    ->selectExternal('templates.name, templates.id')
                                    ->join('templates', 'template_langs.template_id', 'templates.id')
                                    ->where('template_langs.content', '<>', '')->where('`template_langs`.country', 'LIKE', $value->country)->get();

        $select = '<form class="form mb-1" id="formTemplate'.$value->country.'-'.str_replace(' ', '', $value->sender).'" method="post">
                    <select name="template" class="form-control selectHeight mr-2"><option value="">Choose Template</option>';
        foreach ($templates as $template)
            $select .= '<option value="'.$template->id.'" '.($template->id == $value->templateID ? 'selected' : '').'>'.$template->name.'</option>';
        $select .= '</select><input type="hidden" name="country" value="'.$value->country.'"><input type="hidden" name="sender" value="'.$value->sender.'">';
        $select .= '<button class="btn btn-success buttonPading mr-2">Save</button>';
        $select .= '<a title="Unassign template" class="btn btn-danger buttonPading btnDangerWhite cp" onclick="resetTemplate(\''.$value->country.'\', \''.$value->sender.'\')"><i class="fa fa-trash"></i></a></form>';
        return $select;
    }

    public static function buildTemplateButtons($value)
    {
        $exist = TemplateLang::where('template_id', $value->templateID)
            ->where('country', 'LIKE', $value->country)
            ->where('sender', 'LIKE', $value->sender)
            ->first();
        if (empty($exist))
            if (empty($value->templateID) || empty($value->sender) || empty($value->country))
                $button = '<a id="buttonContent-'.$value->country.'" 
                              class="btn btn-primary btnPrimaryColor buttonPading ml-3 mb-1" 
                              href="javascritp:void()"
                              onclick="mustHaveTempalte()">
                              <i class="fa fa-close plusButton"></i>
                           </a><br>';
            else
                $button = '<a id="buttonContent-'.$value->country.'" 
                              class="btn btn-primary btnPrimaryColor buttonPading ml-3 mb-1 buttonContent-'.$value->country.'-sender-'.str_replace(' ', '', $value->sender).'" 
                              href="./add-sender.php?id='.$value->templateID.'&sender='.$value->sender.'&country='.$value->country.'">
                              <i class="fa fa-close plusButton"></i>
                           </a><br>';
        else
            $button = '<a id="buttonContent-'.$value->country.'" 
                          class="btn btn-success ml-3 mb-1 buttonPading buttonContent-'.$value->country.'-sender-'.str_replace(' ', '', $value->sender).'" 
                          href="./edit-sender.php?id='.$exist->id.'">
                          <span class="glyphicon glyphicon-pencil"></span>
                       </a><br>';
        return $button;
    }

    public static function buildTitle($value)
    {
        $titleSenderCountry = Title::where('sender', $value->sender)->where('country', $value->country)->first();
        $title = '';
        if (!empty($value->sender) && !empty($value->country))
            $title = '<div id="title-'.str_replace(' ', '', $value->sender).'-'.$value->country.'" class="d-flex mb-1"><button class="btn btn-primary buttonPading btnPrimaryColor" 
                              title="Add title for sender" 
                              onclick="setTitle(\''.$value->country.'\', \''.$value->sender.'\')" 
                              data-toggle="modal" 
                              data-target="#addTitle">
                              <i class="fa fa-close plusButton"></i>
                      </button></div>';

        if (!empty($titleSenderCountry))
            $title = '<div id="title-'.str_replace(' ', '', $value->sender).'-'.$value->country.'" class="d-flex justify-content-between">
                        <p id="'.$titleSenderCountry->id.'" class="titleName">' . $titleSenderCountry->title . '</p>
                        <button class="btn btn-success buttonPading saveTitle ml-2" data-id="'.$titleSenderCountry->id.'">Save</button>
                        <button class="btn btn-danger buttonPading btnDangerWhite ml-2" 
                                onclick="deleteTitle(\''.$value->country.'\', \''.$value->sender.'\')" 
                                title="Delete title for sender">
                            <i class="fa fa-trash"></i>
                        </button>
                      </div>';
        return $title;
    }

    public static function buildFilters($id, $br = '')
    {
        $countries = SendMail::select('DISTINCT(country)')->orderBy('country', 'ASC')->get();
        $senders   = Home::select('DISTINCT(sender)')->orderBy('sender', 'ASC')->get();
        $products  = Home::select('DISTINCT(product)')->where('product', '<>', '')->orderBy('product', 'ASC')->get();
        $fromDate  = date('d M, Y', strtotime('-7 days'));
        $toDate    = date('d M, Y');
        $option1   = $option2 = $option3 = '<option value="All">All</option>';

        $countryURL = strip_tags($_GET['country' . $br]) ?: '';
        $senderURL  = str_replace('+', ' ', strip_tags($_GET['sender' . $br])) ?: '';
        $productURL = str_replace('+', ' ', strip_tags($_GET['product' . $br])) ?: '';
        $from       = str_replace('+', ' ', strip_tags($_GET['from' . $br])) ?: $fromDate;
        $to         = str_replace('+', ' ', strip_tags($_GET['to' . $br])) ?: $toDate;


        foreach ($countries as $country) $option1 .= '<option value="'.$country->country.'" '.($countryURL == $country->country ? 'selected' : '').'>'.$country->country.'</option>';
        foreach ($senders as $sender) $option2 .= '<option value="'.$sender->sender.'" '.($senderURL == $sender->sender ? 'selected' : '').'>'.$sender->sender.'</option>';
        foreach ($products as $product) $option3 .= '<option value="'.$product->product.'" '.($productURL == $product->product ? 'selected' : '').'>'.$product->product.'</option>';
        return '<div id="'.$id.'" style="width: 48%;" class="'.($br == 2 ? 'd-flex justify-content-center' : '').'">
                    <div class="form-group '.($br == 2 ? 'hidden' : '').'" style="margin-bottom: 0 !important; margin-top: 10px">
                        <label style="margin-left: 6%; margin-bottom: 0">Country</label>
                        <label style="margin-left: 11%; margin-bottom: 0">Sender</label>
                        <label style="margin-left: 12%; margin-bottom: 0">Product</label>
                    </div>
                    <div class="d-flex justify-content-end" style="'.($br == 2 ? 'display:none !important' : '').'">
                        <div class="form-group input-daterange dataRangeForAnalitycs d-flex">
                            <select name="country'.$br.'" class="form-control cp">'.$option1.'</select>
                            <select name="sender'.$br.'" class="form-control cp">'.$option2.'</select>
                            <select name="product'.$br.'" class="form-control cp">'.$option3.'</select>
                            
                            <input id="startDate'.$br.'" type="text" class="form-control cp" value="'.$from.'" autocomplete="off" readonly>
                            <span class="input-group-text user-select">to</span>
                            <input id="endDate'.$br.'" type="text" class="form-control cp" value="'.$to.'" autocomplete="off" readonly>
                            <button id="searchSurvey'.$br.'">Search</button>
                        </div>
                    </div>
                    '.($br == 2 ? '<button style="width: 40%; height: 300px; margin-top: 30%; margin-left: 30%" id="buttonPlusChart"><i class="fa fa-close plusButton"></i></button>' : '').'
                    <figure class="highcharts-figure">
                        <div id="container'.$br.'"></div>
                    </figure>
              </div>';
    }

    public static function buildFiltersProductOverview()
    {
        $countries = SendMail::select('DISTINCT(country)')->orderBy('country', 'ASC')->get();
        $senders   = Home::select('DISTINCT(sender)')->orderBy('sender', 'ASC')->get();
        $products  = Home::select('DISTINCT(product)')->where('product', '<>', '')->orderBy('product', 'ASC')->get();
        $option1   = $option2 = $option3 = '<option value="All">All</option>';

        $countryURL = strip_tags($_GET['country']) ?: '';
        $senderURL  = str_replace('+', ' ', strip_tags($_GET['sender'])) ?: '';
        $productURL = str_replace('+', ' ', strip_tags($_GET['product'])) ?: '';
        $from       = str_replace('+', ' ', strip_tags($_GET['from'])) ?: 'All';
        $to         = str_replace('+', ' ', strip_tags($_GET['to'])) ?: 'All';
        $answerFrom = strip_tags($_GET['answerFrom']) ?: '';
        $answerTo   = strip_tags($_GET['answerTo']) ?: '';


        foreach ($countries as $country) $option1 .= '<option value="'.$country->country.'" '.($countryURL == $country->country ? 'selected' : '').'>'.$country->country.'</option>';
        foreach ($senders as $sender) $option2 .= '<option value="'.$sender->sender.'" '.($senderURL == $sender->sender ? 'selected' : '').'>'.$sender->sender.'</option>';
        foreach ($products as $product) $option3 .= '<option value="'.$product->product.'" '.($productURL == $product->product ? 'selected' : '').'>'.$product->product.'</option>';
        return '<div style="width: 58%;">
                    <div class="form-group" style="margin-bottom: 0 !important; margin-top: 10px">
                        <label style="margin-left: 1%; margin-bottom: 0">Country</label>
                        <label style="margin-left: 5%; margin-bottom: 0">Sender</label>
                        <label style="margin-left: 9%; margin-bottom: 0">Product</label>
                        <label style="margin-left: 17%; margin-bottom: 0">Date range</label>
                        <label style="margin-left: 23%; margin-bottom: 0">Answered range</label>
                    </div>
                    <div class="d-flex justify-content-end">
                        <div class="form-group d-flex">
                            <select name="country" class="form-control cp" style="width: 40%;">'.$option1.'</select>
                            <select name="sender" class="form-control cp">'.$option2.'</select>
                            <select name="product" class="form-control cp">'.$option3.'</select>
                            <div class="d-flex input-daterange dataRangeProductoverview" style="width: 245%;">
                                <input id="startDate" type="text" class="form-control inputForDatapicker cp" value="'.$from.'" autocomplete="off" readonly>
                                <span class="input-group-text user-select">to</span>
                                <input id="endDate" type="text" class="form-control inputForDatapicker cp" value="'.$to.'" autocomplete="off" readonly>                    
                            </div>
                            <input id="answerFrom" type="number" class="form-control" value="'.$answerFrom.'" autocomplete="off">
                            <span  class="input-group-text user-select">to</span>
                            <input id="answerTo" type="number" class="form-control" value="'.$answerTo.'" autocomplete="off">
                        </div>
                    </div>
              </div>';
    }

    public static function buildTicketTemplateButtons($value, $type)
    {
        $exist = TicketTemplates::where('template_id', $value->ticketTemplateID)
            ->where('country', 'LIKE', $value->country)
            ->where('sender', 'LIKE', $value->sender)
            ->where('type', $type)
            ->first();
        $color = $type == 'P' ? 'btn-primary btnPrimaryColor' : 'btn-danger';

        if (empty($exist))
            if (empty($value->ticketTemplateID) || empty($value->sender) || empty($value->country))
                $button = '<a id="buttonContent-'.$value->country.'" 
                              class="btn '.$color.' buttonPading ml-3 mb-1 buttonTicketContent-'.$value->country.'-sender-'.str_replace(' ', '', $value->sender).'-'.$type.'" 
                              href="javascritp:void()"
                              onclick="mustHaveTempalte()">
                              <i class="fa fa-close plusButton"></i>
                           </a><br>';
            else
                $button = '<a id="buttonContent-'.$value->country.'" 
                              class="btn '.$color.' buttonPading ml-3 mb-1 buttonTicketContent-'.$value->country.'-sender-'.str_replace(' ', '', $value->sender).'-'.$type.'" 
                              href="./add-template-ticket.php?id='.$value->ticketTemplateID.'&sender='.str_replace(' ', '+', $value->sender).'&country='.$value->country.'&type='.$type.'">
                              <i class="fa fa-close plusButton"></i>
                           </a><br>';
        else
            $button = '<a id="buttonContent-'.$value->country.'" 
                          class="btn btn-success ml-3 mb-1 buttonPading buttonTicketContent-'.$value->country.'-sender-'.str_replace(' ', '', $value->sender).'-'.$type.'" 
                          href="./edit-template-ticket.php?id='.$exist->id.'">
                          <span class="glyphicon glyphicon-pencil"></span>
                       </a><br>';
        return $button;
    }

    public static function buildTicketTemplates($value)
    {
        $templates = Template2::get();

        $select = '<form class="formTicketTemplateMapping d-flex align-item-center mb-1" id="formTicketTemplate'.$value->country.'-'.str_replace([' ', '.', '+'], ['', '', ''], $value->sender).'" method="post">
                    <select name="template" class="form-control selectHeight mr-2"><option value="">Choose Template</option>';
        foreach ($templates as $template)
            $select .= '<option value="'.$template->id.'" '.($template->id == $value->ticketTemplateID ? 'selected' : '').'>'.$template->name.'</option>';
        $select .= '</select><input type="hidden" name="country" value="'.$value->country.'"><input type="hidden" name="sender" value="'.$value->sender.'">';
        $select .= '<button class="btn btn-success buttonPading mr-2">Save</button>';
        $select .= '<a title="Unassign template" class="btn btn-danger buttonPading btnDangerWhite cp" onclick="resetTicketTemplate(\''.$value->country.'\', \''.$value->sender.'\')"><i class="fa fa-trash"></i></a></form>';
        return $select;
    }

    public static function buildEditContentButton($value)
    {
        $exist = TicketTemplateForCountrySender::where('template_id', $value->ticketTemplateID)
                ->where('country', 'LIKE', $value->country)
                ->where('sender', 'LIKE', $value->sender)
                ->first();
        if (empty($exist))
            $button = '<a id="buttonContent-'.$value->country.'" 
                              class="btn btn-danger buttonPading ml-3 mb-1" 
                              href="javascritp:void()"
                              onclick="mustHaveTempalte()">
                              <i class="fa fa-close plusButton"></i>
                           </a><br>';
        else
            $button = '<a id="buttonContent-'.$value->country.'" 
                          class="btn btn-primary btnPrimaryColor ml-3 mb-1 buttonPading buttonContent-'.$value->country.'-sender-'.str_replace(' ', '', $value->sender).'" 
                          href="./tickettemplate.php?show=noHidden&template='.$value->ticketTemplateID.'&country='.strtoupper($value->country).'&sender='.str_replace(' ', '+', $value->sender).'">
                          <i class="fa fa-close plusButton"></i>
                       </a><br>';
        return $button;
    }
}
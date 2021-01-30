<?php

    /**
    *  Injection of Heuirst core scripts, styles and scripts to init CMS website template 
    * 
    *  It should be included in CMS template php sript in html header section
    *   
    *  include 'websiteScriptAndStyles.php'; 
    *
    * @package     Heurist academic knowledge management system
    * @link        http://HeuristNetwork.org
    * @copyright   (C) 2005-2020 University of Sydney
    * @author      Artem Osmakov   <artem.osmakov@sydney.edu.au>
    * @license     http://www.gnu.org/licenses/gpl-3.0.txt GNU License 3.0
    * @version     4.0
    */

    /*
    * Licensed under the GNU License, Version 3.0 (the "License"); you may not use this file except in compliance
    * with the License. You may obtain a copy of the License at http://www.gnu.org/licenses/gpl-3.0.txt
    * Unless required by applicable law or agreed to in writing, software distributed under the License is
    * distributed on an "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied
    * See the License for the specific language governing permissions and limitations under the License.
    */

if (($_SERVER["SERVER_NAME"]=='localhost'||$_SERVER["SERVER_NAME"]=='127.0.0.1')&& !@$_REQUEST['embed'])  {
    ?>
    <script type="text/javascript" src="<?php echo PDIR;?>external/jquery-ui-1.12.1/jquery-1.12.4.js"></script>
    <script type="text/javascript" src="<?php echo PDIR;?>external/jquery-ui-1.12.1/jquery-ui.js"></script>
    <?php
}else{
    ?>
    <script src="https://code.jquery.com/jquery-1.12.2.min.js" integrity="sha256-lZFHibXzMHo3GGeehn1hudTAP3Sc0uKXBXAzHX1sjtk=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
    <?php
}
?>
<script type="text/javascript" src="<?php echo PDIR;?>external/jquery.layout/jquery.layout-latest.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo PDIR;?>external/jquery-ui-iconfont-master/jquery-ui.icon-font.css" />
    
<!-- CSS -->
<?php 
    //PDIR.
    include dirname(__FILE__).'/../../framecontent/initPageCss.php'; 
    
    if(true || !$edit_Available){ //creates new instance of heurist
        print '<script>window.hWin = window;</script>';
    }
?>
    
<script>
    var _time_debug = new Date().getTime() / 1000;
    var page_first_not_empty = 0;
    var home_page_record_id=<?php echo $home_page_on_init; ?>;
    var init_page_record_id=<?php echo $open_page_on_init; ?>;
    var is_embed =<?php echo array_key_exists('embed', $_REQUEST)?'true':'false'; ?>;
</script>
    
<script type="text/javascript" src="<?php echo PDIR;?>hclient/core/detectHeurist.js"></script>

<script type="text/javascript" src="<?php echo PDIR;?>hclient/core/hapi.js"></script>
<script type="text/javascript" src="<?php echo PDIR;?>hclient/core/utils.js"></script>
<script type="text/javascript" src="<?php echo PDIR;?>hclient/core/utils_dbs.js"></script>
<script type="text/javascript" src="<?php echo PDIR;?>hclient/core/utils_ui.js"></script>
<script type="text/javascript" src="<?php echo PDIR;?>hclient/core/utils_msg.js"></script>
<script type="text/javascript" src="<?php echo PDIR;?>hclient/core/utils_collection.js"></script>
<script type="text/javascript" src="<?php echo PDIR;?>hclient/core/search_minimal.js"></script>
<script type="text/javascript" src="<?php echo PDIR;?>hclient/core/recordset.js"></script>
<script type="text/javascript" src="<?php echo PDIR;?>hclient/core/localization.js"></script>
<script type="text/javascript" src="<?php echo PDIR;?>hclient/core/layout.js"></script>
<script type="text/javascript" src="<?php echo PDIR;?>hclient/core/temporalObjectLibrary.js"></script>

<script type="text/javascript" src="<?php echo PDIR;?>layout_default.js"></script>

<script type="text/javascript" src="<?php echo PDIR;?>hclient/widgets/dropdownmenus/navigation.js"></script>
<script type="text/javascript" src="<?php echo PDIR;?>hclient/widgets/search/svs_list.js"></script>
<script type="text/javascript" src="<?php echo PDIR;?>hclient/widgets/search/search_faceted.js"></script>
<script type="text/javascript" src="<?php echo PDIR;?>hclient/widgets/editing/editing_input.js"></script>
<script type="text/javascript" src="<?php echo PDIR;?>hclient/widgets/viewers/resultList.js"></script>
<script type="text/javascript" src="<?php echo PDIR;?>hclient/widgets/viewers/recordListExt.js"></script>
<script type="text/javascript" src="<?php echo PDIR;?>hclient/widgets/viewers/resultListCollection.js"></script>
<!-- -->
<script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css"/>
    
<?php 

if(is_array($external_files) && count($external_files)>0){
    foreach ($external_files as $ext_file){
        if(strpos($ext_file,'<link')===0 || strpos($ext_file,'<script')===0){
            print $ext_file."\n";
        }
    }
}

if($_SERVER["SERVER_NAME"]=='localhost'||$_SERVER["SERVER_NAME"]=='127.0.0.1'){
        print '<script type="text/javascript" src="'.PDIR.'external/jquery.fancytree/jquery.fancytree-all.min.js"></script>';
}else{
        print '<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.fancytree/2.16.1/jquery.fancytree-all.min.js"></script>';
}   
    print '<link rel="stylesheet" type="text/css" href="'.PDIR.'external/jquery.fancytree/skin-themeroller/ui.fancytree.css" />';


//do not include edit stuff for embed 
if(!array_key_exists('embed', $_REQUEST)){
?>    
    <script type="text/javascript" src="<?php echo PDIR;?>external/jquery-file-upload/js/jquery.iframe-transport.js"></script>
    <script type="text/javascript" src="<?php echo PDIR;?>external/jquery-file-upload/js/jquery.fileupload.js"></script>
    <script type="text/javascript" src="<?php echo PDIR;?>external/js/wellknown.js"></script>
    <script type="text/javascript" src="<?php echo PDIR;?>hclient/core/utils_geo.js"></script>
    
    <script type="text/javascript" src="<?php echo PDIR;?>hclient/widgets/editing/select_imagelib.js"></script>
    <script type="text/javascript" src="<?php echo PDIR;?>hclient/widgets/editing/editing2.js"></script>
    <script type="text/javascript" src="<?php echo PDIR;?>hclient/widgets/editing/editing_exts.js"></script>
    <script type="text/javascript" src="<?php echo PDIR;?>external/js/ui.tabs.paging.js"></script>
    <script type="text/javascript" src="<?php echo PDIR;?>external/js/evol.colorpicker.js" charset="utf-8"></script>
    <link href="<?php echo PDIR;?>external/js/evol.colorpicker.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="<?php echo PDIR;?>hclient/widgets/entity/manageEntity.js"></script>
    <script type="text/javascript" src="<?php echo PDIR;?>hclient/widgets/entity/searchEntity.js"></script>
    <script type="text/javascript" src="<?php echo PDIR;?>hclient/widgets/entity/configEntity.js"></script>
    
    <script type="text/javascript" src="<?php echo PDIR;?>hclient/widgets/entity/manageRecords.js"></script>
    <script type="text/javascript" src="<?php echo PDIR;?>hclient/widgets/entity/searchRecords.js"></script>
    <script type="text/javascript" src="<?php echo PDIR;?>hclient/widgets/entity/manageRecUploadedFiles.js"></script>
    <script type="text/javascript" src="<?php echo PDIR;?>hclient/widgets/entity/searchRecUploadedFiles.js"></script>
    <script type="text/javascript" src="<?php echo PDIR;?>hclient/widgets/entity/manageUsrTags.js"></script>
    <script type="text/javascript" src="<?php echo PDIR;?>hclient/widgets/entity/searchUsrTags.js"></script>
    <script type="text/javascript" src="<?php echo PDIR;?>hclient/widgets/viewers/media_viewer.js"></script>
    
    <script type="text/javascript" src="<?php echo PDIR;?>hclient/widgets/record/recordAction.js"></script>
    <script type="text/javascript" src="<?php echo PDIR;?>hclient/widgets/record/recordAccess.js"></script>
    
    <script type="text/javascript" src="<?php echo PDIR;?>external/tinymce/tinymce.min.js"></script>
    <script type="text/javascript" src="<?php echo PDIR;?>external/tinymce/jquery.tinymce.min.js"></script>
    
    <script type="text/javascript" src="<?php echo PDIR;?>hclient/core/temporalObjectLibrary.js"></script>
    
    <script type="text/javascript" src="<?php echo PDIR;?>admin/structure/import/importStructure.js"></script>
<?php
}

if($edit_Available){
?>
    <script src="<?php echo PDIR;?>external/tinymce/tinymce.min.js"></script>
    <!--
    <script src="<?php echo PDIR;?>external/tinymce5/tinymce.min.js"></script>
    <script src="<?php echo PDIR;?>external/tinymce5/jquery.tinymce.min.js"></script>
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js"></script>
    <script src="<?php echo PDIR;?>external/tinymce/jquery.tinymce.min.js"></script>
    -->
    <script src="websiteRecord.js"></script>
    <?php
}else{
?>    
<script>
//
// init page for publication version  
// for cms version see websiteRecord.js
//
function onPageInit(success)
{

//console.log('webpage onPageInit  '+(new Date().getTime() / 1000 - _time_debug));
_time_debug = new Date().getTime() / 1000;
        
    if(!success) return;
    
    $('#main-menu').hide();
    
    //cfg_widgets is from layout_defaults.js 
    window.hWin.HAPI4.LayoutMgr.init(cfg_widgets, null);
    
    //reload home page content by click on logo
    $("#main-logo").click(function(event){
              loadPageContent( home_page_record_id );
    });
    
    setTimeout(function(){
        //init main menu in page header
        //add menu definitions to main-menu

        var topmenu = $('#main-menu');
        topmenu.attr('data-heurist-app-id','heurist_Navigation');

        function __onInitComplete(not_empty_page){
            //load given page or home page content
            var load_initially = home_page_record_id;
            <?php if($isEmptyHomePage) echo 'if(not_empty_page){ load_initially=not_empty_page;}'; ?>
            
            loadPageContent(init_page_record_id>0 ?init_page_record_id :load_initially);
        }
        
        var menu_cont = $("#main-header");
        if(menu_cont.length==0){
            menu_cont = topmenu.parent();    
        }
               
        window.hWin.HAPI4.LayoutMgr.appInitFromContainer( document, menu_cont,
            {heurist_Navigation:{
                    menu_recIDs: home_page_record_id, 
                    use_next_level: true, 
                    orientation: 'horizontal',
                    toplevel_css: {background:'none'}, //bg_color 'rgba(112,146,190,0.7)'
                    aftermenuselect: afterPageLoad,
                    onInitComplete: __onInitComplete
            }},
            __onInitComplete
            );
            
        topmenu.show();
        
        $(document).trigger(window.hWin.HAPI4.Event.ON_SYSTEM_INITED, []);
        
        var itop = $('#main-header').height(); //[0].scrollHeight;
        //MOVED to top right corner $('#btn_editor').css({top:itop-70, right:20});
        
    },300);
    
    
}

//
//
//
function loadPageContent(pageid){
        if(pageid>0){
              //window.hWin.HEURIST4.msg.bringCoverallToFront($('body').find('#main-content'));
              var page_target = $('#main-content');
              var page_footer = page_target.find('#page-footer');
              if(page_footer.length>0) page_footer.detach();
//console.log('load '+pageid+'   '+page_footer.length);              

              page_target.empty().load(window.hWin.HAPI4.baseURL+'?db='
                        +window.hWin.HAPI4.database+'&field=1&recid='+pageid,
                  function(){
                      
                      var pagetitle = $(page_target.children()[0]);
                      if(pagetitle.is('h2.webpageheading')) pagetitle.remove()
                      $('#main-pagetitle').empty();
                      window.hWin.HAPI4.LayoutMgr.appInitFromContainer( document, '#main-content' );
                      window.hWin.HEURIST4.msg.sendCoverallToBack();

                      if(page_footer.length>0){
                            page_footer.appendTo( page_target );  
                            page_target.css({'min-height':page_target.parent().height()-page_footer.height()-10 });
                      } 
                      
                      afterPageLoad( document, pageid );
              });
              
        }
}
</script>
<?php
}
?>
<script>
var page_scripts = {}; //pageid:functionname   cache to avoid call server every time on page load 

var is_show_pagetitle = false;
<?php if($show_pagetitle){ ?>
        is_show_pagetitle = true;
<?php } ?>        
    
var datatable_custom_render = null;
//
// Executes custom javascript defined in field DT_CMS_SCRIPT
// it wraps this script into function afterPageLoad[RecID] and adds this script into head
// then it executes this function
//
function afterPageLoad(document, pageid){
    
    var DT_CMS_SCRIPT = window.hWin.HAPI4.sysinfo['dbconst']['DT_CMS_SCRIPT'];

    if(DT_CMS_SCRIPT>0 && page_scripts[pageid] !== false){
        
        
        if(!page_scripts[pageid]){
            
            var surl = window.hWin.HAPI4.baseURL+'?db='
                +window.hWin.HAPI4.database+'&field='+DT_CMS_SCRIPT+'&recid='+pageid;
            
            $.get( surl, function( data ) {
                if(data==''){
                    page_scripts[pageid] = false;    
                }else{
                    var func_name = 'afterPageLoad'+pageid;
                    var script = document.createElement('script');
                    script.type = 'text/javascript';
                    script.innerHTML = 'function '+func_name 
                    +'(document, pageid){\n'
                    //+' console.log("run script for '+pageid+'");\n'
                    +'try{\n' + data + '\n}catch(e){}}';
                    //s.src = "http://somedomain.com/somescript";
                    $("head").append(script);
                    page_scripts[pageid] = func_name;    
                    window[func_name]( document, pageid );
                }
            });            
                
            page_scripts[pageid] = false;
        }

        //script may have event listener that is triggered on page exit
        //disable it
        $( "#main-content" ).off( "onexitpage");

        if(page_scripts[pageid] !== false){
            //execute custom script
            window[page_scripts[pageid]]( document, pageid );    
        }
        
    }

    if(!is_embed){    
        var s = location.pathname;
        while (s.substring(0, 2) === '//') s = s.substring(1);
        window.history.pushState("object or string", "Title", s+'?db='
        +window.hWin.HAPI4.database+'&website&id='+home_page_record_id+(pageid!=home_page_record_id?'&pageid='+pageid:''));
    }
    
    
    //find all link elements
    $('a').each(function(i,link){
        
        var href = $(link).attr('href');
        if(href && href!='#'){
            if(  (href.indexOf(window.hWin.HAPI4.baseURL)===0 || href[0] == '?')
                && window.hWin.HEURIST4.util.getUrlParameter('db',href) == window.hWin.HAPI4.database
                && window.hWin.HEURIST4.util.getUrlParameter('id',href) == home_page_record_id)
            {
                var pageid = window.hWin.HEURIST4.util.getUrlParameter('pageid',href);
                if(pageid>0){
                    $(link).attr('data-pageid', pageid);
                    $(link).on({click:function(e){
                        var pageid = $(e.target).attr('data-pageid');
                        loadPageContent(pageid);            
                        window.hWin.HEURIST4.util.stopEvent(e);
                    }});
                    
                }
            }
        }
        
    });
    
}

//
// ->initHeaderElements->onPageInit
//
function onHapiInit(success){   
    
//    console.log('webpage hapi inited  ');//+(new Date().getTime() / 1000 - _time_debug));
    _time_debug = new Date().getTime() / 1000;
    
    if(!success){    
            window.hWin.HEURIST4.msg.showMsgErr('Cannot initialize system on client side, please consult Heurist developers');
            window.hWin.HEURIST4.msg.sendCoverallToBack();            
            return;
    }
    
    var res = window.hWin.HEURIST4.util.versionCompare(window.hWin.HAPI4.sysinfo.db_version_req, 
                                                window.hWin.HAPI4.sysinfo.db_version);   
    if(res==-2){ //-2= db_version_req newer
    window.hWin.HEURIST4.msg.showMsgErr('<h3>Old version database</h3>'
+'<p>You are trying to load a website using a more recent version of Heurist than the one used for the database being accessed.</p>'
+'<p>Please ask the owner of the database to open it in the latest version of Heurist which will apply the necessary updates.</p>');
        window.hWin.HEURIST4.msg.sendCoverallToBack();
        return;
    }

    window.hWin.HAPI4.SystemMgr.get_defs_all(false, null, function(success){
        
        if(success){
    _time_debug = new Date().getTime() / 1000;
            //substitute values in header
            initHeaderElements();
            
            onPageInit(success);
            
            if(window.hWin.HAPI4.sysinfo.host_logo && $('#host_info').length>0){
                
                $('<div style="height:40px;padding-left:4px;float:right">'  //background: white;
                    +'<a href="'+(window.hWin.HAPI4.sysinfo.host_url?window.hWin.HAPI4.sysinfo.host_url:'#')
                    +'" target="_blank" style="text-decoration:none;color:black;">'
                            +'<label>at: </label>'
                            +'<img src="'+window.hWin.HAPI4.sysinfo.host_logo
                            +'" height="35" align="center"></a></div>')
                .appendTo( $('#host_info') );
            }
        }
    });
}


//
//substitute values in header
//
function initHeaderElements(){   
/*
$image_logo  -> #main-logo
$image_altlogo -> #main-logo-alt
$website_title -> #main-title>h2 
*/
  //main logo image
  if($('#main-logo').length>0){
            $('#main-logo').empty();
            $('<a href="#" style="text-decoration:none;"><?php print $image_logo;?></a>')
            .appendTo($('#main-logo'));
  }
  
  if($('#main-logo-alt').length>0){
  <?php if($image_altlogo){ ?>
      var ele = $('#main-logo-alt').css({'background-size':'contain',
                'background-position': 'top',
                'background-repeat': 'no-repeat',
                'background-image':'url(\'<?php print $image_altlogo;?>\')'}).show();
  <?php if($image_altlogo_url){ ?>
        ele.css('cursor','pointer').on({click:function(){window.open("<?php print $image_altlogo_url;?>",'_blank')}});
  <?php }}else{ ?>
      $('#main-logo-alt').hide();
  <?php } ?>
  }
            
  <?php if($website_title){ ?>
  var ele = $('#main-title');
  if(ele.length>0){
      ele.empty().hide();
      $('<h2 style="font-size:1.7em;margin-top:4px;padding:0 10px;max-height:80px;overflow: hidden;"><?php print htmlspecialchars($website_title, ENT_QUOTES);?></h2>').appendTo(ele);
      if(ele.parent().is('#main-header') && !$('#main-logo-alt').is(':visible')){
            ele.css({right:10}); 
      }
      ele.fadeIn(3000);
      setTimeout(function(){ ele.css({left:$('#main-logo').width()+10 }); },2000);
      
  }
  <?php } ?>

  $('.header-element').css({'border':'none'});
  
} //initHeaderElements


var gtag = null;//google log - DO NOT REMOVE

//
//init hapi    
//
$(document).ready(function() {
    
        var ele = $('body').find('#main-content');
        window.hWin.HEURIST4.msg.bringCoverallToFront(ele);
        ele.show();
    
        $('body').find('#main-menu').hide(); //will be visible after menu init
        
        if(is_show_pagetitle){
            $('body').find('#main-pagetitle').show();
        }else{
            $('body').find('#main-pagetitle').hide();
        }
            
console.log('webpage doc ready ');
//+(window.hWin.HAPI4)+'    '+(new Date().getTime() / 1000 - _time_debug));
        _time_debug = new Date().getTime() / 1000;
    
        // Standalone check
        if(!window.hWin.HAPI4){
            window.hWin.HAPI4 = new hAPI('<?php echo $_REQUEST['db']?>', onHapiInit<?php print (array_key_exists('embed', $_REQUEST)?",'".PDIR."'":'');?>);
        }else{
            // Not standalone, use HAPI from parent window
            initHeaderElements();
            onPageInit( true );
        }
});    
</script>    

<style>
<?php
if(!$edit_Available){
?>
div.coverall-div {
    background-position: top;     
    background-color: white;
    opacity: 1;
}
<?php        
}
//style from field DT_CMS_CSS of home record 
if($site_css!=null){
    print $site_css;
}
?>          
</style>  
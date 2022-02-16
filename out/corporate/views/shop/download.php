<?php $obj = new ebapps\corporate\corporate(); $obj -> project_download($projectid); ?>
<?php if($obj->data >= 1) { foreach($obj->data as $val): extract($val);
$download ="";
if(!empty($project_preview_link))
{ 
$download .="<a class='eb-cart-back' href='";
$download .= hypertextWithOrWithoutWww.$project_preview_link;
$download .= "class='button btn-cart'>Preview</a>";
}
if(!empty($project_github_link))
{ 
$download .="<a class='eb-cart-back' href='";
$download .= hypertextWithOrWithoutWww.$project_github_link;
$download .= "class='button btn-cart'>Download</a>";
}
echo $download;
endforeach; 
}
?>

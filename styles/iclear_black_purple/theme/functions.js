
function ToggleDivs(obj,id) {
	var $this = $(obj),
		$id = $(id);
		
	if($id.css('display') == 'block') {
		$this.removeClass('close_icon').addClass('open_icon');
		$id.slideUp('slow');
	} else {
		$this.removeClass('open_icon').addClass('close_icon');
		$id.slideDown('slow');
	}
}

function ToggleDetails(obj,target){
		var $target = $(target+".selected");
			$oldRel = $(target+".selected").attr('rel');
			
			$newTarget = $(obj);
			$newRel = $(obj).attr('rel');
		
			if($oldRel != $newRel) {
				$target.removeClass('selected');
				$newTarget.addClass('selected');
				$("#"+$oldRel).hide();
				$("#"+$newRel).show();
			}
}
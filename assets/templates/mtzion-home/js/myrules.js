	var myrules = {
		'form#pForm' : function(element){
			element.onsubmit = function(){
				if(this.user_id.value == "") {
					alert("Please select a user before submitting info.");
				    this.user_id.focus();
				    return false ;					
				}
				if (this.comments.value == "") {
					alert("Please add a comment before submitting info.");
					this.comments.focus();
					return false;
				}
				return true;
			}
		}
	};
	
	Behaviour.register(myrules);

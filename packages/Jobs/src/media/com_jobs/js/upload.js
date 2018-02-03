/**
 * Author: Rastin Mehr
 * Email: rastin@anahitapolis.com
 * Copyright 2015 rmdStudio Inc. www.rmdStudio.com
 * Licensed under the MIT license:
 * http://www.opensource.org/licenses/MIT
 */

;(function($, window) {
    
    'use strict';
    
    Dropzone.autoDiscover = false;
    
    //multiple file uploader
    $.widget('anahita.jobUpload', {
    	    	
    	_create : function(){
    		
    		var self = this;
    		this.uploadedJobIds = [];
    		
    		var dropzoneOptions = {
    				
    				sending: function(file, xhr, data) {
    					var access = $(this.element).find('select[name="access"]').val();
    					data.append("access", access);
    				},
    				
    				success : function ( file, obj, xhr ){
    					self.uploadedJobIds.push(obj.id);
    				},
    				
    				queuecomplete : function(){

    					if(self.uploadedJobIds.length > 0){
    						var url = self.options.setsUrl;
        					
        					$.each(self.uploadedJobIds, function(index, value){
        						url += '&job_id[]=' + value;
        						});

        					$.get(url, function ( response ){
        						$(self.element).html(response);
        					});
    					}
    				}
    			};
    		
    		dropzoneOptions = $.extend({}, this.options, dropzoneOptions);
    		
    		this.dropzone = new Dropzone(this.options.filedrop, dropzoneOptions);
    		
    		//upload jobs
    		this._on(this.element, {
    			'click [data-trigger="UploadJobs"]' : function ( event ) {
    				event.preventDefault();
    				this.dropzone.enqueueFiles(this.dropzone.getFilesWithStatus(Dropzone.ADDED));
    			} 
    		});
    		
    		//remove jobs
    		this._on(this.element, {
    			'click [data-trigger="RemoveJobs"]' : function ( event ) {
    				event.preventDefault();
    				this.dropzone.removeAllFiles(true);
    			} 
    		});
    	}
    });
    
    //Jobs to set assignment
    $.widget('jobs.jobsSetAssignment',{
    	
    	_create : function () {
    		
    		var textField = $(this.element).find('input[name="title"]');
    		var selector = $(this.element).find('select[name="id"]');
    		
    		this._on(selector, {
    			'change' : function ( event ) {
    				if($(event.target).val() != '' )
    					textField.attr('disabled', true);
    				else
    					textField.attr('disabled', false);
    			}
    		});
    		
    		this._on(textField, {
    			'change' : function ( event ) {
    				if($(event.target).val() != '' )
    					selector.attr('disabled', true);
    				else
    					selector.attr('disabled', false);
    			}
    		});
    	}
    	
    });
    
    $(document).ajaxSuccess( function() {
    	$('#jobs-set-assignment').jobsSetAssignment();
    });

}(jQuery, window));    
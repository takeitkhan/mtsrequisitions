<div class="card tile is-child">
    <header class="card-header">
        <p class="card-header-title" style="">
            <span class="icon"><i class="fas fa-tasks default"></i></span>
            Action Panel
        </p>
    </header>
    <div class="card-content">
        <div class="card-data">
            <div class="columns">
                <div class="column">
                    <?php if(auth()->user()->isManager(auth()->user()->id) && $task->override_status == 'No'): ?>
                        <?php echo e(Form::open(array('url' => route('tasks.update', $task->id), 'method' => 'PUT', 'value' => 'PATCH', 'id' => 'add_route', 'class' => 'task_table', 'files' => true, 'autocomplete' => 'off'))); ?>

                        <input type="hidden" name="finish_editing" value="Yes"/>
                        <button onclick="return confirm('Are you sure?')" type="submit" class="button is-info is-small">
                            Finish editing and send to approver
                        </button>
                        <?php echo e(Form::close()); ?>

                    <?php endif; ?>

                    <?php if(auth()->user()->isManager(auth()->user()->id)): ?>
                        <?php echo $__env->make('task::taskaction.ready_for_assign_to_head', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    <?php endif; ?>


                    <?php if(auth()->user()->isApprover(auth()->user()->id)): ?>
                  		    <?php
                              //echo date('hia');
                              $approval_time_end = \App\Models\Setting::timeSettings('approval_time_end');
                              //echo $taskCreationEndTime;
                              if(!empty($approval_time_end) && date('Hi') > $approval_time_end){
                                echo '<div class="notification is-danger py-1">Approve Time is Over. You can not approve task after '.numberToTimeFormat($approval_time_end ?? '').' </div>';
                              }else{
                           ?>
                  				<!--if Task created Date is over && Approver can not Approve within task create date As ApproverApprovenDateIsOver -->
                  				<?php if( $task->created_at->format('Y-m-d') > date('Y-m-d') ): ?>
                  				 	<div class="notification is-danger py-1">Approver Date is Over. You can not Approve  any more.</div>
                  				<?php else: ?>
                        			<?php echo $__env->make('task::taskaction.task_approver_accept_decline', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                  				<?php endif; ?> <!-- ApproverApprovenDateIsOver -->
                  			
                  			<?php } ?>
                  		
                    <?php endif; ?>


                    
                    <?php
                    global $taskID;
                    $taskID = $task->id;
                    global $requisition_id;
                    $requisition_id = !empty($taskrequisitionbill) ? $taskrequisitionbill->id : NULL;

                    function rData($arg)
                    {
                        global $taskID;
                        global $requisition_id;
                        $data = Tritiyo\Task\Models\TaskRequisitionBill::where('task_id', $taskID)->first();
                        if (isset($data) && $data[$arg]) {
                            return 'Yes';
                        } else {
                            return 'No';
                        }
                    }
                    function rDataApprove($arg)
                    {
                        global $taskID;
                        global $requisition_id;
                        $data = Tritiyo\Task\Models\TaskRequisitionBill::where('task_id', $taskID)->first();
                        if (isset($data) && $data[$arg]) {
                            return $data[$arg];
                        }
                    }
                    //dump(rDataApprove('requisition_approved_by_cfo') );
                    ?>
					<?php 
                  		//Logic test
                  		//echo 
                         $task_created_date = $task->created_at->format('Y-m-d');
                  		 $today_date = date('Y-m-d');
                  		 if($today_date > $task_created_date){
                         	//echo 'Not possible';
                         }
                  		//echo Carbon\Carbon::today();
                  
                  	?>

                    <?php if(auth()->user()->isManager(auth()->user()->id) && rData('requisition_prepared_by_manager') == 'Yes'): ?>
                        <?php
                            $requsition_submission_manager_end = \App\Models\Setting::timeSettings('requsition_submission_manager_end');
                  			//Requisition Sunbmit Time Restrict //RequiistionTimeIsOver
                   			if(!empty($requsition_submission_manager_end) && date('Hi') > $requsition_submission_manager_end){
                  				 echo '<div class="notification is-danger py-1">Requisition Submit Time is Over. You can not submit requisition after '.numberToTimeFormat($approval_time_end ?? '').' </div>';
                  			}else{
                  				//if Task created Date is over && Manager can not submit requisition within task create date As RequistionSubmissionDateIsOver
                  				if( !empty($requsition_submission_manager_end) && date('Y-m-d') > $task->created_at->format('Y-m-d') ){
                  				 	echo '<div class="notification is-danger py-1">Requisition Submit Date is Over. You can not submit requisition any more.</div>'; 
                  				} else {
                                  echo Tritiyo\Task\Helpers\RequisitionBillHelper::requisitionBillActionHelper([
                                      'approve_code' => 'requisition_submitted_by_manager',
                                      'task_id' => $task->id,
                                      'action_performed_by' => auth()->user()->id,
                                      'performed_for' => null,
                                      'requisition_id' => $requisition_id,
                                      'message' => null,
                                      'buttonValue' => 'Send to CFO',
                                      'showOrNot' => false
                                  ]);
                  				}  //RequistionSubmissionDateIsOver	
                  		  	}  //RequiistionTimeIsOver
                        ?>
                    <?php endif; ?>


                    <?php if(auth()->user()->isCFO(auth()->user()->id) && (rData('requisition_edited_by_cfo') == 'Yes' || rDataApprove('requisition_approved_by_cfo') != null)): ?>
                  		  <?php
                              //echo date('hia');
                  			  $cfo_restriction = \App\Models\Setting::otherSettings('cfo_restriction');
                              $requsition_submission_cfo_end = \App\Models\Setting::timeSettings('requsition_submission_cfo_end');
                  				//
                              //echo  date('Hia');
                              if($cfo_restriction == 1 && !empty($requsition_submission_cfo_end) && date('Hi') > $requsition_submission_cfo_end){
                                echo '<div class="notification is-danger py-1">Approve Time is Over. You can not approve Requision after '.numberToTimeFormat($requsition_submission_cfo_end).' </div>';
                              }else{
                           ?>
                              <?php
                  				  //if Task created Date is over && CFO can not Approve requisition within task create date As CFOApproveDateIsOver
                                  if( $cfo_restriction == 1 &&  date('Y-m-d') > $task->created_at->format('Y-m-d') ){
                                      echo '<div class="notification is-danger py-1">Approve Date is Over. You can not approve any more.</div>'; 
                                  }else {
                                    echo Tritiyo\Task\Helpers\RequisitionBillHelper::requisitionBillActionHelper([
                                        'approve_code' => 'requisition_approved_by_cfo',
                                        'decline_code' => 'requisition_declined_by_cfo',
                                        'task_id' => $task->id,
                                        'action_performed_by' => auth()->user()->id,
                                        'performed_for' => null,
                                        'requisition_id' => $requisition_id,
                                        'message' => null,
                                        'buttonValue' => 'Send to Accountant',
                                        'showOrNot' => true
                                    ]);
                  				  }//CFOApproveDateIsOver
                              ?>
                  			<?php } ?>
                    <?php endif; ?>

                    <?php if(auth()->user()->isAccountant(auth()->user()->id)): ?>
                        <?php if((rData('requisition_edited_by_accountant') == 'Yes' && rData('requisition_approve_amount_accountant') == 'Yes'  || rDataApprove('requisition_approved_by_accountant') != null)): ?>
                            <?php
                                echo Tritiyo\Task\Helpers\RequisitionBillHelper::requisitionBillActionHelper([
                                    'approve_code' => 'requisition_approved_by_accountant',
                                    'decline_code' => 'requisition_declined_by_accountant',
                                    'task_id' => $task->id,
                                    'action_performed_by' => auth()->user()->id,
                                    'performed_for' => null,
                                    'requisition_id' => $requisition_id,
                                    'message' => null,
                                    'buttonValue' => 'Requisition Approve',
                                    'showOrNot' => true
                                ]);
                            ?>
                        <?php endif; ?>

                            <?php if(rData('requisition_edited_by_accountant') == 'Yes' && rData('requisition_approve_amount_accountant') == 'No'): ?>
                                <form action="<?php echo e(route('requsition.approve.amount.send')); ?>" method="post">
                                    <?php echo csrf_field(); ?>
                                    <?php
                                        //dump($requisition_id);
                                            //ALTER TABLE `tasks_requisition_bill` ADD `requisition_approve_amount_accountant` TEXT NULL AFTER `requisition_edited_by_accountant`;
                                              $siteHeadMobileBankingInfo = \App\Models\User::where('id', $task->site_head)->first()->mbanking_information;
                                              $accountantApprovedrequisitionAmount =  (new \Tritiyo\Task\Helpers\SiteHeadTotal('requisition_edited_by_accountant', $task->id))->getTotal()

                                    ?>
                                    <input type="hidden" name="requesition_id" value="<?php echo e($requisition_id); ?>">
                                    <input type="hidden" name="requesition_approve_amount" value="<?php echo e($accountantApprovedrequisitionAmount); ?>">
                                    <?php if(!empty($siteHeadMobileBankingInfo)): ?>
                                        <?php $explodeBnakingInfo =  explode(' | ', $siteHeadMobileBankingInfo) ?>
                                        <label for="bill_number" class="label">Select Mobile Banking</label>
                                        <select name="mobile_bank_method" class="input is-small" id="mobile_bank_method" required>
                                            <option>Select Mobile Banking</option>
                                            <?php $__currentLoopData = $explodeBnakingInfo; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php $mBank = explode(' : ', $data) ?>
                                                <option value="<?php echo e($mBank[0] ?? NULL); ?>" data-number="<?php echo e($mBank[1] ?? NULL); ?>"><?php echo e($mBank[0] ?? NULL); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <option value="Cheque" data-number="<?php echo e(NULL); ?>">Cheque</option>
                                        </select>
                                  	<?php else: ?>
                                  		<div class="has-background-danger">No Mobile Banking info added</div>
                                    <?php endif; ?>
                                    <input type="hidden" id="mobile_bank_number" name="mobile_bank_number" value="" />
                                    <div class="mobile_bank_number"></div>
                                    <button class="button is-link is-small my-1" style="display:none" id="requ_btn"  type="submit">Send BDT <?php echo e($accountantApprovedrequisitionAmount); ?></button>
                                </form>
                            <?php endif; ?>

                <?php endif; ?>

           </div>

           <div class="column">
               <?php  $task_status = \Tritiyo\Task\Models\TaskStatus::where('task_id', $task->id)->orderBy('id', 'desc')->first(); ?>
               <?php if($task_status->code == 'head_declined' || $task_status->code == 'approver_declined' || $task_status->code == 'requisition_declined_by_cfo' || $task_status->code == 'requisition_declined_by_accountant'): ?>
                   <?php
                       $red = 'statusDangerMessage';
                   ?>
               <?php endif; ?>
               <?php
                   $task_decline_reason = \Tritiyo\Task\Models\TaskDecline::where('task_id', $task->id)->orderBy('created_at', 'desc')->first();
               ?>
               <div class="<?php echo e(!empty($red) ? $red : 'statusSuccessMessage'); ?>" style="display:block">

                   <div><?php echo e($task_status->message ?? Null); ?> </div>
                   <?php echo e(!empty($task_decline_reason->decline_reason) && $task_status->code == $task_decline_reason->code ? 'Reason:'. $task_decline_reason->decline_reason : Null); ?>

                   <div class="has-text-black-ter has-text-weight-medium"><?php echo e($task_status->created_at); ?></div>
                 
                 	   <?php if(auth()->user()->isAdmin(auth()->user()->id)): ?>
                          <div class="has-text-black-ter has-text-weight-medium">
                            	Action performed by: <?php echo e(\App\Models\User::where('id', $task_status->action_performed_by)->first()->name); ?>

                  		 </div>
                      <?php endif; ?>
                 	<span><a href="<?php echo e(route('tasks.show', $task->id)); ?>">view all status</a></span>
               </div>
               <?php if(auth()->user()->isApprover(auth()->user()->id) && ($task->override_status == 'Yes' || $task->override_status == 'Overriden')): ?>
                   <a href="<?php echo e(route('tasks.manager.overridden.data', $task->id)); ?>" target="_blank">
                       <div class="statusSuccessMessage has-background-link-dark mt-2 has-text-white-ter">
                           Previous Data of Manager
                       </div>
                   </a>
               <?php endif; ?>

           </div>
       </div>
       <div class="columns">
           <div class="column">

               <?php if( auth()->user()->isManager(auth()->user()->id) && $task->override_status == 'No'): ?>
                   <article class="message is-danger">
                       <div class="message-body">
                           ফিনিশ এডিটিং বাটন চাপার পর আপনি কখনোই আর পরিবর্তন করতে পারবেন না। তাই ভালো ভাবে দেখে
                           এরপর ফিনিশ বাটন চাপুন।
                       </div>
                   </article>
               <?php endif; ?>
           </div>
       </div>

   </div>
</div>
</div>


<script>
$('select#mobile_bank_method').change(function(){
 let number = $(this).find('option:selected').attr('data-number');
 let ele = '<div class="button is-warning my-1 is-block">'+number+'</div>';
 if(number !== undefined) {
     $('.mobile_bank_number').empty().append(ele);
     $('input#mobile_bank_number').val(number);
     $('#requ_btn').attr('style','display: block');
 } else {
     $('.mobile_bank_number').empty();
     $('input#mobile_bank_number').val('');
     $('#requ_btn').attr('style','display: none');
 }
})
</script>

<?php /**PATH D:\oldwindows\laragon\www\mtsrequisitions\vendor\tritiyo\task\src/views/taskaction/accept_decline.blade.php ENDPATH**/ ?>
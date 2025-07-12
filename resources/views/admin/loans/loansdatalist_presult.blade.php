<table id="data-table" class="table table-striped table-bordered">
<thead>
<tr>
<th>Loan Number</th>
<th>Loan Product</th>
<th>Client</th>
<th>Date</th>
<th>Amount</th>
<th>Interest Rate Type</th>
<th>Interest Rate</th>
<th>Status</th>
<th>Action</th>
</tr>
</thead>
<tbody>
@foreach ($loansdata['list'] as $loans)
<tr>
<td class='table-text'><div>
{!! $loans->loan_number !!}
</div></td>
<td class='table-text'><div>
{!! $loans->loanproductmodel->name !!}
</div></td>
<td class='table-text'><div>
{!! $loans->clientmodel->client_number !!}
{!! $loans->clientmodel->first_name !!}
{!! $loans->clientmodel->middle_name !!}
{!! $loans->clientmodel->last_name !!}
</div></td>
<td class='table-text'><div>
{!! $loans->date !!}
</div></td>
<td class='table-text'><div>
{!! $loans->amount !!}
</div></td>
<td class='table-text'><div>
{!! $loans->interestratetypemodel->name !!}
</div></td>
<td class='table-text'><div>
{!! $loans->interest_rate !!}
</div></td>
<td class='table-text'><div>
@if($loans['loanstatusmodel']['code']=='001')
<span class="label label-warning">{!! $loans->loanstatusmodel->name !!}</span>
@elseif($loans['loanstatusmodel']['code']=='002')
<span class="label label-success">{!! $loans->loanstatusmodel->name !!}</span>
@elseif( $loans['loanstatusmodel']['code']=='003')
<span class="label label-danger">{!! $loans->loanstatusmodel->name !!}</span>
@endif
</div></td>
<td>
<div class="btn-group m-r-5 m-b-5">
<a href="javascript:;" data-toggle="dropdown" class="btn btn-default dropdown-toggle">Action <span class="caret"></span></a>
<ul class="dropdown-menu">
<li>@if($loansdata['usersaccountsroles'][0]->_show==1)
<a href="{!! route('loans.show',$loans->id) !!}" id='show-loans-{!! $loans->id !!}' >
View Loan                                            
</a>
@endif</li>
<li>@if($loansdata['usersaccountsroles'][0]->_edit==1)
<a href="{!! url('admin/loanapproval/'.$loans->id) !!}" >Approve Loan</a>  @endif</li>
</ul>
</div>
<!-- <form action="{!! route('loans.destroy',$loans->id) !!}" method="POST">
@if($loansdata['usersaccountsroles'][0]->_delete==1)
<input type="hidden" name="_method" value="delete" />
{!! csrf_field() !!}
{!! method_field('DELETE') !!}
<button type='submit' id='delete-loans-{!! $loans->id !!}' class='btn btn-sm btn-circle btn-danger'>
</button>
@endif
</form> -->
</td>
</tr>
@endforeach
</tbody>
</table>

{!! $loansdata['list']->links() !!}
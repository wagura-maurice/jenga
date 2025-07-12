<table id="data-table" class="table table-striped table-bordered">
<thead>
    <tr>
        <th>Account</th>
        <th>Entry Type</th>
        <th>Transaction Number</th>
        <th>Amount</th>
        <th>Date</th>
    </tr>
</thead>
<tbody>
    @foreach ($generalledgersdata['list'] as $generalledgers)
    <tr>
        <td class='table-text'><div>
            {!! $generalledgers->accountmodel->code !!}
            {!! $generalledgers->accountmodel->name !!}
        </div></td>
        <td class='table-text'><div>
            {!! $generalledgers->entrytypemodel->name !!}
        </div></td>
        <td class='table-text'><div>
            {!! $generalledgers->transaction_number !!}
        </div></td>
        <td class='table-text'><div>
            {!! $generalledgers->amount !!}
        </div></td>
        <td class='table-text'><div>
            {!! $generalledgers->date !!}
        </div></td>
    </tr>
    @endforeach
</tbody>
</table>

{!! $generalledgersdata['list']->links() !!}
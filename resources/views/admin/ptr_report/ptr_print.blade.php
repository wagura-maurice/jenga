<table>
    <thead>
        <tr>
            <th>CLIENT ID</th>
            <th>CLIENT NAME</th>
            <th>LOAN NUMBER</th>
            <th>LOAN INCEPTION DATE</th>
            <th>LOAN AMOUNT</th>
            <th>EXPECTED PAYMENT PERIOD</th>
            <th>LAST PAYMENT DATE</th>
            <th>PAYMENT AMOUNT</th>
            <th>ARREARS PER PERIOD</th>
            <th>ARREARS AMOUNT</th>
            <th>NEXT PAYMENT DATE</th>
            <th>OLB</th>
            <th>LAST LGF DATE</th>
            <th>LGF AMOUNT</th>
            <th>TOTAL</th>
        </tr>
    </thead>
    <tbody>
        <?php $r = 0; ?>
        @foreach ($groupsdata['clientcontributions'] as $clientcontribution)
            @forelse($clientcontribution['loans'] as $loan)
                @if ($loop->first)
                    @if (isset($clientcontribution))
                        <tr id="<?php ++$r;
                        echo $r; ?>">
                            <td>
                                {!! $clientcontribution['client']['client_number'] !!}
                            </td>
                            <td>
                                {!! $clientcontribution['client']['first_name'] !!} {!! $clientcontribution['client']['middle_name'] !!} {!! $clientcontribution['client']['last_name'] !!}
                            </td>
                            <td>
                                {!! $loan->loan_number !!}
                            </td>
                            <td>
                                {!! date('d-m-Y', strtotime($loan->date)) !!}
                            </td>
                            <td>
                                {!! $loan->amount !!}

                            </td>
                            <td>
                                {!! $loan->exppay !!}

                            </td>
                            <td>
                                {!! $loan->lastpaydate !!}
                            </td>
                            <td>
                                {!! $loan->lastpayamount !!}
                            </td>
                            @if ($loan->arrears < 0)
                                <td>
                                    <span class="label label-warning">
                                        {!! $loan->arrears_period !!}
                                    </span>
                                </td>
                            @else
                                <td>
                                    {!! $loan->arrears_period !!}
                                </td>
                            @endif
                            @if ($loan->arrears < 0)
                                <td>
                                    <span class="label label-warning">
                                        {!! $loan->arrears !!}
                                    </span>
                                </td>
                            @else
                                <td>
                                    {!! $loan->arrears !!}
                                </td>
                            @endif
                            @if ($loan->arrears < 0)
                                <td>
                                    <span class="label label-warning">
                                        {!! $loan->nextpay !!}
                                    </span>
                                </td>
                            @else
                                <td>
                                    {!! $loan->nextpay !!}
                                </td>
                            @endif
                            <td>
                                {!! $loan->rembalance !!}
                            </td>
                            <td>
                                @if (isset($clientcontribution['lgf']['lastcontributiondate']))
                                    {!! \Carbon\Carbon::parse($clientcontribution['lgf']['lastcontributiondate'])->toDateString() !!}
                                @endif
                            </td>
                            <td>
                                @if (isset($clientcontribution['lgf']['lastcontributiondate']))
                                    {!! $clientcontribution['lgf']['lastcontribution'] !!}
                                @endif
                            </td>
                            <td>
                                @if (isset($clientcontribution['lgf']['lastcontributiondate']))
                                    {!! $clientcontribution['lgf']['totallgfcontribution'] !!}
                                @endif
                            </td>
                        </tr>
                    @endif
                @else
                    <tr id="<?php ++$r;
                    echo $r; ?>">
                        <td></td>
                        <td></td>
                        <td>
                            {!! $loan->loan_number !!}
                        </td>
                        <td>
                            {!! date('d-m-Y', strtotime($loan->date)) !!}
                        </td>
                        <td>
                            {!! $loan->amount !!}
                        </td>
                        <td>
                            {!! $loan->exppay !!}
                        </td>
                        <td>
                            {!! $loan->lastpaydate !!}
                        </td>
                        <td>
                            {!! $loan->lastpayamount !!}
                        </td>
                        @if ($loan->arrears < 0)
                            <td>
                                {!! $loan->arrears_period !!}
                            </td>
                        @else
                            <td>
                                {!! $loan->arrears_period !!}
                            </td>
                        @endif
                        @if ($loan->arrears < 0)
                            <td>
                                {!! $loan->arrears !!}
                            </td>
                        @else
                            <td>
                                {!! $loan->arrears !!}
                            </td>
                        @endif
                        @if ($loan->arrears < 0)
                            <td>
                                {!! $loan->nextpay !!}
                            </td>
                        @else
                            <td>
                                {!! $loan->nextpay !!}
                            </td>
                        @endif
                        <td>
                            {!! $loan->rembalance !!}
                        </td>
                        <td>
                            @if (isset($clientcontribution['lgf']['lastcontributiondate']))
                                {!! \Carbon\Carbon::parse($clientcontribution['lgf']['lastcontributiondate'])->toDateString() !!}
                            @endif
                        </td>
                        <td>
                            @if (isset($clientcontribution['lgf']['lastcontributiondate']))
                                {!! $clientcontribution['lgf']['lastcontribution'] !!}
                            @endif
                        </td>
                        <td>
                            @if (isset($clientcontribution['lgf']['lastcontributiondate']))
                                {!! $clientcontribution['lgf']['totallgfcontribution'] !!}
                            @endif
                        </td>
                    </tr>
                @endif
            @empty
                @if (isset($clientcontribution))
                    <tr id="<?php ++$r;
                    echo $r; ?>">
                        <td>
                            {!! $clientcontribution['client']['client_number'] !!}
                        </td>
                        <td>
                            {!! $clientcontribution['client']['first_name'] !!} {!! $clientcontribution['client']['middle_name'] !!} {!! $clientcontribution['client']['last_name'] !!}
                        </td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                            @if (isset($clientcontribution['lgf']['lastcontributiondate']))
                                {!! \Carbon\Carbon::parse($clientcontribution['lgf']['lastcontributiondate'])->toDateString() !!}
                            @endif
                        </td>
                        <td>
                            @if (isset($clientcontribution['lgf']['lastcontributiondate']))
                                {!! $clientcontribution['lgf']['lastcontribution'] !!}
                            @endif
                        </td>
                        <td>
                            @if (isset($clientcontribution['lgf']['lastcontributiondate']))
                                {!! $clientcontribution['lgf']['totallgfcontribution'] !!}
                            @endif
                        </td>
                    </tr>
                @endif
            @endforelse
        @endforeach
    </tbody>
</table>

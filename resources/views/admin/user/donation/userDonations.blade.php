@php
    $donations = App\Models\Donation::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();
@endphp
<div class="card">
    <div class="card-header">
        <h3 class="card-title line-height-36">
            Donation History
        </h3>
    </div>
    <table class="table table-hover text-nowrap table-bordered">
        <thead>
            <tr class="text-center">
                <th width="2%">#</th>
                <th width="5%">Food Name</th>
                <th width="10%">Quantity</th>
                <th width="10%">Status</th>
                <th width="10%">Action</th>
            </tr>
        </thead>
        <tbody>
            @if ($donations->count() > 0)
                @foreach ($donations as $donation)
                    <tr>
                        <td class="text-center" tabindex="0">
                            {{ $loop->index + 1 }}
                        </td>
                        <td class="text-center" tabindex="0">
                            {{ $donation->name }}
                        </td>
                        <td class="text-center" tabindex="0">
                            {{ $donation->quantity }} {{ \App\Helper::getUnit()[$donation->unit] }}
                        </td>
                        <td class="text-center" tabindex="0">
                            {{ \App\Helper::getStatus()[$donation->status] }}
                        </td>
                        {{-- <td class="text-center" tabindex="0">
                            {{ date('j F, Y', strtotime($job->deadline)) }}
                        </td> --}}
                        <td class="text-center">
                            <a href="" class="btn bg-info ml-1"><i
                                    class="fas fa-eye"></i></a>
                            <a href=""
                                onclick="return confirm('{{ __('are_you_sure_you_want_to_delete_this_item') }}');"
                                class="d-inline btn btn-danger"><i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="7" class="text-center">{{ __('no_data_found') }}</td>
                </tr>
            @endif
        </tbody>
    </table>
</div>

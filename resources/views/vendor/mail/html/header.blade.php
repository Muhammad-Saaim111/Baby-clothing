@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block; text-decoration: none;">
    @if(config('app.env') === 'local')
        <span style="font-family: 'Outfit', sans-serif; font-size: 28px; font-weight: 700; color: #d48c70; letter-spacing: 1px;">AiM<span style="color: #df7a76;">'</span>EE</span>
    @else
        <img src="{{ asset('assets/images/logo_clean.png') }}" class="logo" alt="AiM'EE" style="height: auto; max-height: 50px; display: block; margin: 0 auto; color: #d48c70; font-size: 24px; font-weight: bold;">
    @endif
</a>
</td>
</tr>

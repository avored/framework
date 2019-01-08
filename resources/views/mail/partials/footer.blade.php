

<!-- Footer -->
<tr>
    <td>
        <table style="{{ $style['email-footer'] }}" align="center" width="570" cellpadding="0"
               cellspacing="0">
            <tr>
                <td style="{{ $fontFamily }} {{ $style['email-footer_cell'] }}">
                    <p style="{{ $style['paragraph-sub'] }}">
                        &copy; {{ date('Y') }}
                        <a style="{{ $style['anchor'] }}" href="{{ url('/') }}"
                           target="_blank">{{ config('app.name') }}</a>.
                        Todos os direitos reservados. <i>Uma plataforma LeadStore</i>
                    </p>
                </td>
            </tr>
        </table>
    </td>
</tr>

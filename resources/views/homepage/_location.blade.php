<div class="ui vertical quote segment container" style="padding: 3em 0em">
    <div class="ui grid container">
        <h3 style="margin-left: -.5em">Lokasi</h3>
        <table class="ui celled fixed table">
            <tbody>
            <tr>
            @for($i = 0; $i < count($location); $i++)
                <td class="selectable"><a href="{{ url("/search?province=".$location[$i]->id) }}">{{ ucwords(strtolower($location[$i]->name)) }}</a></td>
                @if(($i + 1) % 3 === 0)
                </tr><tr>
                @endif
            @endfor
            <td></td><td></td></tr>
            </tbody>
        </table>
    </div>
</div>
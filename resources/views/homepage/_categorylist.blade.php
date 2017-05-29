<div class="ui vertical stripe quote segment container">
    <div class="ui left aligned grid" id="category-list">
        <div class="eight wide column">
            <h3>Kategori</h3>
        </div>
        <div class="right floated right aligned eight wide column">
            <a href="#">Lihat Semua</a>
        </div>
    </div>
    <table class="ui celled table">
        @php($i = 0)
        @while($i < count($categories))
            <tr>
                @for($j=0; $j < 3; $j++)
                    <td class="selectable">
                        <a href="#">{{ $categories[$i]->name }}</a>
                    </td>
                    @php
                        $i++;
                        if($i == count($categories)) {
                            break;
                        }
                    @endphp
                @endfor
            </tr>
        @endwhile
    </table>
</div>
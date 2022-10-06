<div class=" py-3" next-page-hide>
    @if (!empty($categoria))
        <h2 class="text-white" style="margin-bottom: -6px;">
            {{!empty($categoria) ? $categoria->titulo : 'Memes del dia'}}
        </h2>
        @if ($categoria->slug == 'ultimos-memes')
            <div style="font-size: 14px;line-height: 1.1;" class="text-white mb-1">En esta sección <span class="fw-bold">los posteos aun no fueron aprobados</span>, puedes mirarlos bajo tu propio riesgo.</div>
        @endif
    @elseif (!empty($titulo))
    <h2 class="text-white">
       #{{str_replace('-',' ',$titulo)}}
    </h2>
    @else
    <h2 class="text-white">
        Memes del dia
    </h2>
    @endif
</div>

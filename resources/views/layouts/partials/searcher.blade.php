<div class="form-group">
    <div class="input-group">
        <input id="search"
               autofocus
               name="search"
               type="text"
               class="form-control"
               placeholder="Buscar"
               value="{{(isset($search)) ? $search : ''}}"
        >
        <span class="input-group-addon">
        <button class="link" type="submit">
            <i class="fa fa-search"></i>
        </button>
        </span>
    </div>
</div>

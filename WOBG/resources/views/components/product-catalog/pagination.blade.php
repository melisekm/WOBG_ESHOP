<div class="row mt-5">
    <div class="col">
        {{ $products->links("pagination::bootstrap-4") }}
    </div>
    <div class="col-lg-3 col-md-4 pt-2">
        <select class="form-select" id="per_page" aria-label="Per page select">
            <option value="3" @if($pagination["per_page"] == 3) selected @endif>Per page 3</option>
            <option value="10" @if($pagination["per_page"] == 10) selected @endif>Per page 10</option>
            <option value="25" @if($pagination["per_page"] == 25) selected @endif>Per page 25</option>
        </select>
    </div>
</div>

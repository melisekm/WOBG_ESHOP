<ul class="timeline mt-4 ">
    <li class="step complete">
        <div class="status">
            <div><a @if($step > 1) onclick="window.history.back()" @endif href="#"
                    class="black-link">Information</a></div>
        </div>
    </li>
    <li class="step @if($step > 1) complete @endif">
        <div class="status">
            @if($step > 1)
                <div><a href="#" class="black-link">Review</a></div>
            @else
                <div> Review</div>
            @endif
        </div>
    </li>
    <li class="step @if($step > 2) complete @endif">
        <div class="status">
            <div>Payment</div>
        </div>
    </li>
    <li class="step @if($step > 2) complete @endif">
        <div class="status">
            <div>Done</div>
        </div>
    </li>
</ul>

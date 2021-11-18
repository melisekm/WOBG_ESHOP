<ul class="timeline mt-4 ">
    <li class="step complete">
        <div class="status">
            <div>
                @if($step == 2)
                    <a onclick="window.history.back()" href="#"
                       class="black-link">Information</a>
                @else
                    Information
                @endif
            </div>
        </div>
    </li>
    <li class="step @if($step > 1) complete @endif">
        <div class="status">
            <div> Review</div>
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

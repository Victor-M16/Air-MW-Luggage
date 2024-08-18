@extends('layouts.app')

@section('title', 'Register Luggage')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Register Luggage</h1>

    <!-- Form to enter customer and luggage details -->
    <form id="initial-form" action="{{ route('luggage.store') }}" method="POST" class="mb-4">
        @csrf
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="ticket_number">Ticket Number:</label>
            <input type="text" id="ticket_number" name="ticket_number" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="num_bags">Number of Bags:</label>
            <input type="number" id="num_bags" name="num_bags" class="form-control" min="1" required>
        </div>
        <div class="form-group">
            <label for="num_items_per_bag">Number of Items per Bag:</label>
            <input type="number" id="num_items_per_bag" name="num_items_per_bag" class="form-control" min="1" required>
        </div>
        <button type="button" class="btn btn-primary" id="submit_initial_form">Submit</button>
    </form>
    
    <!-- Modal for entering characteristics -->
    <div class="modal fade" id="characteristicsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Enter Item Characteristics</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modal-body-content">
                    <!-- Dynamic content will be loaded here -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="save_characteristics">Save</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('submit_initial_form').addEventListener('click', function() {
    var numBags = document.getElementById('num_bags').value;
    var numItemsPerBag = document.getElementById('num_items_per_bag').value;

    var modalBody = document.getElementById('modal-body-content');
    modalBody.innerHTML = '';

    for (var i = 0; i < numBags; i++) {
        for (var j = 0; j < numItemsPerBag; j++) {
            modalBody.innerHTML += `
                <div class="form-group">
                    <label for="characteristic_1_${i}_${j}">Bag ${i + 1}, Item ${j + 1} - Characteristic 1:</label>
                    <input type="text" id="characteristic_1_${i}_${j}" name="characteristics[${i}][${j}][0]" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="characteristic_2_${i}_${j}">Bag ${i + 1}, Item ${j + 1} - Characteristic 2:</label>
                    <input type="text" id="characteristic_2_${i}_${j}" name="characteristics[${i}][${j}][1]" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="characteristic_3_${i}_${j}">Bag ${i + 1}, Item ${j + 1} - Characteristic 3:</label>
                    <input type="text" id="characteristic_3_${i}_${j}" name="characteristics[${i}][${j}][2]" class="form-control" required>
                </div>
            `;
        }
    }
    
    console.log("Modal content prepared.");
    $('#characteristicsModal').modal('show');
});

document.getElementById('save_characteristics').addEventListener('click', function() {
    console.log("Save button clicked. Submitting form.");
    document.getElementById('initial-form').submit();
});

</script>
@endsection

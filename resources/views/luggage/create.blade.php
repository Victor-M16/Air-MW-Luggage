@extends('layouts.app')

@section('title', 'Register Luggage')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Register Luggage</h1>

    <!-- Form to enter customer and luggage details -->
    <form action="{{ route('luggage.store') }}" method="POST" class="mb-4">
        @csrf
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="ticket_number">Ticket Number:</label>
            <input type="text" id="ticket_number" name="ticket_number" class="form-control" required>
        </div>

        <div id="bags">
            <div class="bag mb-4" data-bag="0">
                <h4>Bag 1</h4>
                <div class="form-group">
                    <label for="bag_description_0">Bag Description:</label>
                    <input type="text" id="bag_description_0" name="bags[0][description]" class="form-control" required>
                </div>

                <div class="items">
                    <div class="item mb-2" data-item="0">
                        <h5>Item 1</h5>
                        <div class="form-group">
                            <label for="char1_0_0">Characteristic 1:</label>
                            <input type="text" id="char1_0_0" name="bags[0][items][0][char1]" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="char2_0_0">Characteristic 2:</label>
                            <input type="text" id="char2_0_0" name="bags[0][items][0][char2]" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="char3_0_0">Characteristic 3:</label>
                            <input type="text" id="char3_0_0" name="bags[0][items][0][char3]" class="form-control" required>
                        </div>
                        <button type="button" class="btn btn-danger remove-item">Remove Item</button>
                    </div>
                </div>
                <button type="button" class="btn btn-secondary add-item">Add Item</button>
                <button type="button" class="btn btn-danger remove-bag">Remove Bag</button>
            </div>
        </div>
        
        <button type="button" class="btn btn-primary add-bag">Add Bag</button>
        <button type="submit" class="btn btn-success mt-4">Submit</button>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let bagCount = 1;
    
    // Function to update bag headings after adding/removing
    function updateBagHeadings() {
        let bags = document.querySelectorAll('.bag');
        bags.forEach((bag, index) => {
            bag.setAttribute('data-bag', index);
            bag.querySelector('h4').textContent = `Bag ${index + 1}`;
            bag.querySelectorAll('.item').forEach((item, itemIndex) => {
                item.querySelector('h5').textContent = `Item ${itemIndex + 1}`;
                item.querySelectorAll('input').forEach((input) => {
                    let name = input.getAttribute('name');
                    let newName = name.replace(/\[\d+\]/g, `[${index}]`).replace(/\[\d+\]/g, `[${itemIndex}]`);
                    input.setAttribute('name', newName);
                    let id = input.getAttribute('id');
                    let newId = id.replace(/\_\d+\_\d+/, `_${index}_${itemIndex}`);
                    input.setAttribute('id', newId);
                });
            });
        });
    }

    // Add a new bag
    document.querySelector('.add-bag').addEventListener('click', function() {
        let bagsDiv = document.getElementById('bags');
        let newBagDiv = document.createElement('div');
        newBagDiv.classList.add('bag', 'mb-4');
        newBagDiv.setAttribute('data-bag', bagCount);

        newBagDiv.innerHTML = `
            <h4>Bag ${bagCount + 1}</h4>
            <div class="form-group">
                <label for="bag_description_${bagCount}">Bag Description:</label>
                <input type="text" id="bag_description_${bagCount}" name="bags[${bagCount}][description]" class="form-control" required>
            </div>
            <div class="items">
                <div class="item mb-2" data-item="0">
                    <h5>Item 1</h5>
                    <div class="form-group">
                        <label for="char1_${bagCount}_0">Characteristic 1:</label>
                        <input type="text" id="char1_${bagCount}_0" name="bags[${bagCount}][items][0][char1]" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="char2_${bagCount}_0">Characteristic 2:</label>
                        <input type="text" id="char2_${bagCount}_0" name="bags[${bagCount}][items][0][char2]" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="char3_${bagCount}_0">Characteristic 3:</label>
                        <input type="text" id="char3_${bagCount}_0" name="bags[${bagCount}][items][0][char3]" class="form-control" required>
                    </div>
                    <button type="button" class="btn btn-danger remove-item">Remove Item</button>
                </div>
            </div>
            <button type="button" class="btn btn-secondary add-item">Add Item</button>
            <button type="button" class="btn btn-danger remove-bag">Remove Bag</button>
        `;
        bagsDiv.appendChild(newBagDiv);
        bagCount++;
    });

    // Remove a bag
    document.getElementById('bags').addEventListener('click', function(event) {
        if (event.target.classList.contains('remove-bag')) {
            event.target.closest('.bag').remove();
            bagCount--;
            updateBagHeadings();
        }
    });

    // Add a new item
    document.getElementById('bags').addEventListener('click', function(event) {
        if (event.target.classList.contains('add-item')) {
            let itemsDiv = event.target.closest('.bag').querySelector('.items');
            let itemCount = itemsDiv.querySelectorAll('.item').length;
            let bagIndex = event.target.closest('.bag').getAttribute('data-bag');

            let newItemDiv = document.createElement('div');
            newItemDiv.classList.add('item', 'mb-2');
            newItemDiv.setAttribute('data-item', itemCount);

            newItemDiv.innerHTML = `
                <h5>Item ${itemCount + 1}</h5>
                <div class="form-group">
                    <label for="char1_${bagIndex}_${itemCount}">Characteristic 1:</label>
                    <input type="text" id="char1_${bagIndex}_${itemCount}" name="bags[${bagIndex}][items][${itemCount}][char1]" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="char2_${bagIndex}_${itemCount}">Characteristic 2:</label>
                    <input type="text" id="char2_${bagIndex}_${itemCount}" name="bags[${bagIndex}][items][${itemCount}][char2]" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="char3_${bagIndex}_${itemCount}">Characteristic 3:</label>
                    <input type="text" id="char3_${bagIndex}_${itemCount}" name="bags[${bagIndex}][items][${itemCount}][char3]" class="form-control" required>
                </div>
                <button type="button" class="btn btn-danger remove-item">Remove Item</button>
            `;
            itemsDiv.appendChild(newItemDiv);
        }
    });

    // Remove an item
    document.getElementById('bags').addEventListener('click', function(event) {
        if (event.target.classList.contains('remove-item')) {
            event.target.closest('.item').remove();
            updateBagHeadings();
        }
    });
});
</script>
@endsection

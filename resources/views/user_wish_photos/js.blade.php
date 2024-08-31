@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/4.5.0/fabric.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var canvas = new fabric.Canvas('editor-canvas');
    var templateId = '{{ $template->id }}';

    // Load template image and dynamically set the canvas size
    fabric.Image.fromURL('{{ asset("storage/" . $template->image_path) }}', function(img) {
        var imageWidth = img.width;
        var imageHeight = img.height;
        canvas.setWidth(imageWidth);
        canvas.setHeight(imageHeight);

        // Set the loaded image as the canvas background
        canvas.setBackgroundImage(img, canvas.renderAll.bind(canvas), {
            scaleX: 1,
            scaleY: 1
        });
    });

    // Add text button logic
    document.getElementById('add-text').addEventListener('click', function() {
        var fontFamily = document.getElementById('font-family').value;
        var backgroundColor = document.getElementById('text-background-color').value;
        var backgroundOpacity = parseFloat(document.getElementById('text-background-opacity').value);

        // Create fabric.Color object for background color and set its opacity
        var colorWithOpacity = new fabric.Color(backgroundColor);
        colorWithOpacity.setAlpha(backgroundOpacity);

        var text = new fabric.IText('Edit me', {
            left: 50,
            top: 50,
            fontFamily: fontFamily,
            fontSize: parseInt(document.getElementById('font-size').value),
            fill: document.getElementById('text-color').value,
            backgroundColor: colorWithOpacity.toRgba()
        });

        // Load the font explicitly before adding the text to the canvas
        new FontFaceObserver(fontFamily).load().then(function() {
            canvas.add(text);
            canvas.setActiveObject(text); // Automatically select the new text
            canvas.renderAll();
        }).catch(function() {
            console.error('Font ' + fontFamily + ' could not be loaded');
            canvas.add(text);
            canvas.setActiveObject(text); // Automatically select the new text
            canvas.renderAll();
        });
    });

    // Delete text button logic
    document.getElementById('delete-text').addEventListener('click', function() {
        var activeObject = canvas.getActiveObject();
        if (activeObject && activeObject.type === 'i-text') {
            canvas.remove(activeObject);
            canvas.discardActiveObject();
            canvas.renderAll();
        } else {
            alert('Please select a text object to delete.');
        }
    });

    // Reset button logic with confirmation
    document.getElementById('reset-canvas').addEventListener('click', function() {
        if (confirm('Are you sure you want to reset the canvas? This will remove all changes.')) {
            // Clear all objects from the canvas
            canvas.clear();

            // Re-load the background image (if necessary)
            fabric.Image.fromURL('{{ asset("storage/" . $template->image_path) }}', function(img) {
                canvas.setBackgroundImage(img, canvas.renderAll.bind(canvas), {
                    scaleX: 1,
                    scaleY: 1
                });
            });
        }
    });

    // Cancel button logic with confirmation
    document.getElementById('cancel-button').addEventListener('click', function(event) {
        event.preventDefault(); // Prevent immediate navigation
        if (confirm('Are you sure you want to cancel? All unsaved changes will be lost.')) {
            window.location.href = this.getAttribute('href'); // Redirect if confirmed
        }
    });




    // Update text properties logic
    ['font-size', 'text-color', 'font-family', 'font-weight', 'font-style', 'text-align', 'text-background-color', 'text-background-opacity'].forEach(function(id) {
        var element = document.getElementById(id);
        if (element) {
            element.addEventListener('change', function() {
                var activeObject = canvas.getActiveObject();
                if (activeObject && activeObject.type === 'i-text') {
                    if (id === 'font-size') activeObject.set('fontSize', parseInt(this.value));
                    if (id === 'text-color') activeObject.set('fill', this.value);
                    if (id === 'font-family') activeObject.set('fontFamily', this.value);
                    if (id === 'font-weight') activeObject.set('fontWeight', this.value);
                    if (id === 'font-style') activeObject.set('fontStyle', this.value);
                    if (id === 'text-align') activeObject.set('textAlign', this.value);
                    if (id === 'text-background-color') activeObject.set('backgroundColor', this.value);
                    if (id === 'text-background-opacity') {
                        var currentColor = new fabric.Color(activeObject.backgroundColor);
                        currentColor.setAlpha(parseFloat(this.value));
                        activeObject.set('backgroundColor', currentColor.toRgba());
                    }
                    canvas.renderAll();
                }
            });
        }
    });

    // Underline text logic
    document.getElementById('underline-text').addEventListener('click', function() {
        var activeObject = canvas.getActiveObject();
        if (activeObject && activeObject.type === 'i-text') {
            activeObject.set('underline', !activeObject.underline);
            canvas.renderAll();
        }
    });

    // Save button logic
    document.getElementById('save-button').addEventListener('click', function() {
        var customizationData = canvas.toJSON();
        var canvasWidth = canvas.width;
        var canvasHeight = canvas.height;
        var backgroundImage = canvas.backgroundImage;
        var backgroundWidth = backgroundImage ? backgroundImage.width : canvasWidth;
        var backgroundHeight = backgroundImage ? backgroundImage.height : canvasHeight;

        fetch('{{ route("user-wish-photos.store") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                wish_photo_template_id: templateId,
                customization_data: JSON.stringify(customizationData),
                canvas_width: canvasWidth,
                canvas_height: canvasHeight,
                background_width: backgroundWidth,
                background_height: backgroundHeight
            })
        })
        .then(response => {
            if (!response.ok) {
                return response.text().then(text => {
                    try {
                        return JSON.parse(text);
                    } catch (e) {
                        return { success: false, message: text };
                    }
                });
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                window.location.href = '{{ route("user-wish-photos.index") }}';
            } else {
                console.error('Server response:', data);
                alert('Error saving wish photo: ' + (data.message || 'Unknown error'));
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while saving the wish photo: ' + error);
        });
    });
});
</script>
@endpush

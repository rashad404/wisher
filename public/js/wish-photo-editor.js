/******/ (() => { // webpackBootstrap
/*!*******************************************!*\
  !*** ./resources/js/wish-photo-editor.js ***!
  \*******************************************/
document.addEventListener('DOMContentLoaded', function () {
  var canvas = new fabric.Canvas('editor-canvas');

  // Use the global templateImageUrl variable defined in the Blade template
  fabric.Image.fromURL(templateImageUrl, function (img) {
    var imageWidth = img.width;
    var imageHeight = img.height;
    canvas.setWidth(imageWidth);
    canvas.setHeight(imageHeight);
    canvas.setBackgroundImage(img, canvas.renderAll.bind(canvas), {
      scaleX: 1,
      scaleY: 1
    });
  });

  // Add text button logic
  document.getElementById('add-text').addEventListener('click', function () {
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
      // Set the initial font family
      fontSize: parseInt(document.getElementById('font-size').value),
      fill: document.getElementById('text-color').value,
      backgroundColor: colorWithOpacity.toRgba() // Apply background color with opacity
    });

    // Load the font explicitly before adding the text to the canvas
    new FontFaceObserver(fontFamily).load().then(function () {
      canvas.add(text);
      canvas.renderAll();
    })["catch"](function () {
      console.error('Font ' + fontFamily + ' could not be loaded');
      canvas.add(text);
      canvas.renderAll();
    });
  });

  // Update text properties logic
  ['font-size', 'text-color', 'font-family', 'font-weight', 'font-style', 'text-align', 'text-background-color', 'text-background-opacity'].forEach(function (id) {
    var element = document.getElementById(id);
    if (element) {
      element.addEventListener('change', function () {
        console.log('id', id); // Debugging log
        var activeObject = canvas.getActiveObject();
        if (activeObject && activeObject.type === 'i-text') {
          if (id === 'font-size') activeObject.set('fontSize', parseInt(this.value));
          if (id === 'text-color') {
            activeObject.set('fill', this.value);
            console.log('regular color', this.value); // Debugging log
          }

          if (id === 'font-family') activeObject.set('fontFamily', this.value);
          if (id === 'font-weight') activeObject.set('fontWeight', this.value);
          if (id === 'font-style') activeObject.set('fontStyle', this.value);
          if (id === 'text-align') activeObject.set('textAlign', this.value);
          if (id === 'text-background-color') activeObject.set('backgroundColor', this.value);
          if (id === 'text-background-opacity') {
            // Adjust the opacity of the background color
            var currentColor = new fabric.Color(activeObject.backgroundColor); // Create a fabric.Color object
            currentColor.setAlpha(parseFloat(this.value)); // Set the alpha value for the color
            activeObject.set('backgroundColor', currentColor.toRgba()); // Convert back to RGBA string
          }

          canvas.renderAll();
        }
      });
    }
  });

  // Underline text logic
  document.getElementById('underline-text').addEventListener('click', function () {
    var activeObject = canvas.getActiveObject();
    if (activeObject && activeObject.type === 'i-text') {
      activeObject.set('underline', !activeObject.underline);
      canvas.renderAll();
    }
  });

  // Save button logic
  document.getElementById('save-button').addEventListener('click', function () {
    console.log(23);
    var customizationData = canvas.toJSON();
    var canvasWidth = canvas.width;
    var canvasHeight = canvas.height;
    var backgroundImage = canvas.backgroundImage;
    var backgroundWidth = backgroundImage ? backgroundImage.width : canvasWidth;
    var backgroundHeight = backgroundImage ? backgroundImage.height : canvasHeight;
    console.log(storeUrl);
    fetch(storeUrl, {
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
    }).then(function (response) {
      if (!response.ok) {
        return response.text().then(function (text) {
          try {
            // Try to parse as JSON
            return JSON.parse(text);
          } catch (e) {
            // If it's not JSON, return an object with the text
            return {
              success: false,
              message: text
            };
          }
        });
      }
      return response.json();
    }).then(function (data) {
      if (data.success) {
        window.location.href = '{{ route("user.wish-photos.index") }}';
      } else {
        console.error('Server response:', data);
        alert('Error saving wish photo: ' + (data.message || 'Unknown error'));
      }
    })["catch"](function (error) {
      console.error('Error:', error);
      alert('An error occurred while saving the wish photo: ' + error);
    });
  });
});
/******/ })()
;
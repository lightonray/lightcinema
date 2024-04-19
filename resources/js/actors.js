const actorInputField = document.getElementById('actor-input-field');

actorInputField.addEventListener('keydown', function(event) {
  if (event.key === 'Enter' || event.keyCode === 13) {
    event.preventDefault();
    const actorName = this.value.trim();
    if (actorName !== '') {
      addActor(actorName);
      this.value = '';
    }
  }
});

function addActor(name) {
  const chip = document.createElement('div');
  chip.classList.add('actor-chip');
  chip.textContent = name;

  // Create close button
  const closeButton = document.createElement('div');
  closeButton.textContent = '×';
  closeButton.classList.add('close-button');
  closeButton.addEventListener('click', function(event) {
    event.stopPropagation(); // Prevent chip click event from firing
    chip.remove();
  });

  // Append close button to chip
  chip.appendChild(closeButton);

  // Append chip to the actor input container
  const actorInput = document.getElementById('actor-input');
  actorInput.appendChild(chip);

  // Create hidden input to store actor name in form submission
  const hiddenInput = document.createElement('input');
  hiddenInput.setAttribute('type', 'hidden');
  hiddenInput.setAttribute('name', 'actors[]');
  hiddenInput.setAttribute('value', name);
  actorInput.appendChild(hiddenInput);
}

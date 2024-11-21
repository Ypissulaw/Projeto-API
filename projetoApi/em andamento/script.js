document.getElementById('noteForm').addEventListener('submit', async function(event) {
    event.preventDefault();

    const title = document.getElementById('title').value;
    const body = document.getElementById('body').value;

    console.log(`Title: ${title}, Body: ${body}`);

    const response = await fetch('http://localhost/projetoApi/insert.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: `title=${encodeURIComponent(title)}&body=${encodeURIComponent(body)}`
    });

    const result = await response.json();
    console.log(result);

    loadNotes();
});

async function loadNotes() {
    const response = await fetch('http://localhost/projetoApi/getall.php', {
        method: 'GET'
    });

    const notes = await response.json();
    const notesContainer = document.getElementById('notesContainer');
    notesContainer.innerHTML = '';

    notes.result.forEach(note => {
        const noteElement = document.createElement('div');
        noteElement.classList.add('note');
        noteElement.innerHTML = `<h2>${note.title}</h2><p>${note.body}</p>`;
        notesContainer.appendChild(noteElement);
    });
}

window.onload = loadNotes;

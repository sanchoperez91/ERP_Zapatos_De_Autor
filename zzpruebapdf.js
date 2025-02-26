document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('pdfForm');
    const pdfList = document.getElementById('pdfList');
    const pdfViewer = document.getElementById('pdfViewer');
    const editModal = document.getElementById('editModal');
    const editForm = document.getElementById('editForm');
    const span = document.getElementsByClassName('close')[0];

    form.addEventListener('submit', (e) => {
        e.preventDefault();
        
        const pdfName = document.getElementById('pdfName').value;
        const userName = document.getElementById('userName').value;
        const userEmail = document.getElementById('userEmail').value;
        const userPhone = document.getElementById('userPhone').value;
        const userAddress = document.getElementById('userAddress').value;
        const userData = document.getElementById('userData').value;
        
        createPDF(pdfName, userName, userEmail, userPhone, userAddress, userData);
    });

    function createPDF(name, userName, userEmail, userPhone, userAddress, userData) {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF();
        
        // Añadir imagen
        const imgData = 'digitech.jpg'; // URL o ruta de la imagen
        doc.addImage(imgData, 'JPEG', 150, 10, 50, 30);
        
        // Añadir título
        doc.setFontSize(30);
        doc.setFont('times', 'bold');
        doc.text('ESCANDALLOS', 20, 20);
        
        doc.setFontSize(22);
        doc.text(name, 20, 40);
        
        // Añadir tabla con datos
        doc.setFontSize(12);
        doc.setFont('times', 'normal');
        doc.autoTable({
            startY: 50,
            head: [['Campo', 'Valor']],
            body: [
                ['Nombre', userName],
                ['Correo Electrónico', userEmail],
                ['Teléfono', userPhone],
                ['Dirección', userAddress],
                ['Datos Adicionales', userData]
            ],
            theme: 'grid',
            styles: {
                font: 'times',
                fontSize: 12
            }
        });
        
        const pdfBlob = doc.output('blob');
        const pdfUrl = URL.createObjectURL(pdfBlob);
        
        const pdfContainer = document.createElement('div');
        pdfContainer.innerHTML = `
            <h3>${name}</h3>
            <button onclick="downloadPDF('${pdfUrl}', '${name}')">Descargar PDF</button>
            <button onclick="showPDF('${pdfUrl}')">Mostrar PDF</button>
            <button onclick="hidePDF()">Dejar de Mostrar PDF</button>
            <button onclick="deletePDF(this)">Eliminar PDF</button>
            <button class="boton-modificar" onclick="modificarElemento('${name}', '${userName}', '${userEmail}', '${userPhone}', '${userAddress}', '${userData}', this)">Modificar PDF</button>
        `;
        
        pdfList.appendChild(pdfContainer);
    }

    window.downloadPDF = (url, name) => {
        const a = document.createElement('a');
        a.href = url;
        a.download = `${name}.pdf`;
        a.click();
    };

    window.showPDF = (url) => {
        pdfViewer.style.display = 'block';
        pdfViewer.src = url;
    };

    window.hidePDF = () => {
        pdfViewer.style.display = 'none';
        pdfViewer.src = '';
    };

    window.deletePDF = (element) => {
        element.parentElement.remove();
        if (pdfList.children.length === 0) {
            pdfViewer.style.display = 'none';
        }
    };

    window.modificarElemento = (name, userName, userEmail, userPhone, userAddress, userData, element) => {
        document.getElementById('editPdfName').value = name;
        document.getElementById('editUserName').value = userName;
        document.getElementById('editUserEmail').value = userEmail;
        document.getElementById('editUserPhone').value = userPhone;
        document.getElementById('editUserAddress').value = userAddress;
        document.getElementById('editUserData').value = userData;
        editModal.style.display = 'block';

        editForm.onsubmit = (e) => {
            e.preventDefault();
            
            const newName = document.getElementById('editPdfName').value;
            const newUserName = document.getElementById('editUserName').value;
            const newUserEmail = document.getElementById('editUserEmail').value;
            const newUserPhone = document.getElementById('editUserPhone').value;
            const newUserAddress = document.getElementById('editUserAddress').value;
            const newUserData = document.getElementById('editUserData').value;
            
            // Actualizar el contenido del PDF
            const { jsPDF } = window.jspdf;
            const doc = new jsPDF();
            
            doc.addImage('digitech.jpg', 'JPEG', 150, 10, 50, 30);
            doc.setFontSize(30);
            doc.setFont('times', 'bold');
            doc.text('ESCANDALLOS', 20, 20);
            
            doc.setFontSize(22);
            doc.text(newName, 20, 40);
            
            doc.setFontSize(12);
            doc.setFont('times', 'normal');
            doc.autoTable({
                startY: 50,
                head: [['Campo', 'Valor']],
                body: [
                    ['Nombre', newUserName],
                    ['Correo Electrónico', newUserEmail],
                    ['Teléfono', newUserPhone],
                    ['Dirección', newUserAddress],
                    ['Datos Adicionales', newUserData]
                ],
                theme: 'grid',
                styles: {
                    font: 'times',
                    fontSize: 12
                }
            });
            
            const pdfBlob = doc.output('blob');
            const pdfUrl = URL.createObjectURL(pdfBlob);
            
            // Actualizar el contenedor del PDF
            element.parentElement.querySelector('h3').textContent = newName;
            element.parentElement.querySelector('button[onclick^="downloadPDF"]').setAttribute('onclick', `downloadPDF('${pdfUrl}', '${newName}')`);
            element.parentElement.querySelector('button[onclick^="showPDF"]').setAttribute('onclick', `showPDF('${pdfUrl}')`);
            element.parentElement.querySelector('button[onclick^="modificarElemento"]').setAttribute('onclick', `modificarElemento('${newName}', '${newUserName}', '${newUserEmail}', '${newUserPhone}', '${newUserAddress}', '${newUserData}', this)`);
            
            editModal.style.display = 'none';
        };
    };

    span.onclick = () => {
        editModal.style.display = 'none';
    };

    window.onclick = (event) => {
        if (event.target == editModal) {
            editModal.style.display = 'none';
        }
    };
});
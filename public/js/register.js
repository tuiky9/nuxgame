document.addEventListener('DOMContentLoaded', () => {
    const apiUrl = '/register';

    const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    const form = document.getElementById('registerForm');
    const submitBtn = document.getElementById('submitBtn');

    const statusEl = document.getElementById('status');
    const errorsEl = document.getElementById('errors');

    const userBlock = document.getElementById('userBlock');
    const userId = document.getElementById('userId');
    const userName = document.getElementById('userName');
    const userPhone = document.getElementById('userPhone');
    const userLink = document.getElementById('userLink');

    function setStatus(text) {
        statusEl.textContent = text || '';
    }

    function showErrors(errors) {
        const lines = [];
        for (const [field, msgs] of Object.entries(errors || {})) {
            for (const msg of msgs) lines.push(`${field}: ${msg}`);
        }
        errorsEl.innerHTML = lines.length ? `<ul>${lines.map(l => `<li>${l}</li>`).join('')}</ul>` : '';
    }

    function showUser(user) {
        userId.textContent = user.id ?? '';
        userName.textContent = user.username ?? '';
        userPhone.textContent = user.phonenumber ?? '';
        const linkUrl = user.links[0].url ?? '';
        userLink.href = linkUrl || '#';
        userLink.textContent = linkUrl || '';
        userBlock.style.display = 'block';
    }

    form.addEventListener('submit', async (e) => {
        e.preventDefault();

        setStatus('');
        showErrors({});
        userBlock.style.display = 'none';

        submitBtn.disabled = true;
        setStatus('Submitting...');

        const payload = {
            username: document.getElementById('username').value,
            phonenumber: document.getElementById('phonenumber').value,
        };

        try {
            const res = await fetch(apiUrl, {
                method: 'POST',
                credentials: 'same-origin',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrf,
                },
                body: JSON.stringify(payload),
            });

            const data = await res.json().catch(() => ({}));

            if (!res.ok) {
                setStatus(data.message || 'Request failed.');
                showErrors(data.errors || {});
                return;
            }

            setStatus(data.message || 'Success!');
            if (data.username) {
                showUser(data);
            }
        } catch (err) {
            setStatus('Network error. Please try again.');
        } finally {
            submitBtn.disabled = false;
        }
    });
});

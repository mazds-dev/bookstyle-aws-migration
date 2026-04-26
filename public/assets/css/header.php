/* Header container */
header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1rem 2rem;
    background-color: #111827; /* dark gray/black */
    color: #fff;
    flex-wrap: wrap;
    border-bottom: 3px solid #4ade80; /* nice green highlight */
}

/* Branding (logo/name) */
header .branding h1 {
    font-size: 1.8rem;
    margin: 0;
    color: #4ade80;
    font-weight: bold;
}

/* Nav links */
header nav {
    display: flex;
    gap: 1rem;
    flex-wrap: wrap;
}

header nav a {
    color: #e5e7eb;
    text-decoration: none;
    font-weight: 500;
    padding: 0.5rem;
    transition: color 0.3s ease;
}

header nav a:hover {
    color: #4ade80; /* green hover effect */
}

/* Cart badge */
header nav .cart-badge {
    background-color: #10b981;
    color: white;
    border-radius: 50%;
    padding: 2px 8px;
    font-size: 13px;
    font-weight: bold;
    display: inline-block;
    min-width: 24px;
    text-align: center;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    header {
        flex-direction: column;
        align-items: flex-start;
    }

    header nav {
        flex-direction: column;
        width: 100%;
        margin-top: 1rem;
    }

    header nav a {
        padding-left: 0;
    }
}

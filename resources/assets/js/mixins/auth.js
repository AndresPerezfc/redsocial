let user = document.head.querySelector('meta[name="user"]');

module.exports = {
    computed: {
        usuarioActual() {
            return JSON.parse(user.content);
        },
        estaAutenticado() {
            return !!user.content;
        },
        guest() {
            return !this.estaAutenticado;
        }
    },
    methods: {
        redireccionarInvitado() {
            if (this.guest) return (window.location.href = "/login");
        }
    }
};

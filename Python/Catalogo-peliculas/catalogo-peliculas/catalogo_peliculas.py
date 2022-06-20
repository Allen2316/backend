import tkinter as tk
from client.gui_app import Frame, barra_menu


def main():
    root = tk.Tk()
    root.title("Catalogo de peliculas")
    # siempre poner la ruta completa de la img
    root.iconbitmap(
        "C:\\Users\\Allen\\Desktop\\Desktop\\Proyectos\\backend\\Python\\Catalogo-peliculas\\catalogo-peliculas\\img\\cp-logo.ico")
    root.resizable(0, 0)

    barra_menu(root)

    app = Frame(root=root)
    

    app.mainloop()


if __name__ == "__main__":
    main()

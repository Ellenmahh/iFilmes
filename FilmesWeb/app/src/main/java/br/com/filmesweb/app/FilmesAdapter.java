package br.com.filmesweb.app;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ArrayAdapter;
import android.widget.ImageView;
import android.widget.TextView;

import com.squareup.picasso.Picasso;

/**
 * Created by 15251383 on 03/11/2016.
 */
public class FilmesAdapter extends ArrayAdapter<Filme> {

    int resource;

    public FilmesAdapter(Context context, int resource, Filme[] objects) {
        super(context, resource, objects);
        this.resource = resource;
    }

    @Override
    public View getView(int position, View convertView, ViewGroup parent) {

        View v = convertView;

        if (v == null){

            LayoutInflater inflater = LayoutInflater.from(getContext());
            v = inflater.inflate(resource,null);
        }

        Filme filme = getItem(position);

        ImageView img_filme = (ImageView) v.findViewById(R.id.img_filme);
        TextView txt_nome_filme = (TextView) v.findViewById(R.id.txt_nome_filme);
        TextView txt_categoria_filme = (TextView) v.findViewById(R.id.txt_categoria_filme);

        txt_nome_filme.setText(filme.getNome());
        txt_categoria_filme.setText(filme.getCategoria().getDescricao());


        if(filme.getImagem() !=null &&  !filme.getImagem().isEmpty()) {

            String caminhoImg =  getContext().getString(R.string.endServidor)+ "/img/" + filme.getImagem();

            Picasso.with(getContext()).load(caminhoImg).into(img_filme);
        }


        return v;
    }
}

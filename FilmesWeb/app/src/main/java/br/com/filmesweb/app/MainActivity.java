package br.com.filmesweb.app;

import android.app.ProgressDialog;
import android.content.Context;
import android.os.AsyncTask;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.Toolbar;
import android.util.Log;
import android.view.View;
import android.widget.ListView;

import com.google.gson.Gson;

public class MainActivity extends AppCompatActivity {

    ListView list_view;
    FilmesAdapter adapter;

    public static Context context;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        Toolbar toolbar = (Toolbar) findViewById(R.id.toolbar);
        setSupportActionBar(toolbar);

        context = this;

        list_view = (ListView) findViewById(R.id.list_view);

        Categoria ct = new Categoria();
        ct.setId(1);
        ct.setDescricao("Drama");

        Filme f = new Filme();
        f.setNome("Narcos");
        f.setCategoria(ct);


        Filme[] lstFilmes =  new Filme[1];
        lstFilmes[0] = f;


        adapter = new FilmesAdapter(this, R.layout.list_view_item,lstFilmes);
        list_view.setAdapter(adapter);

        new ObterDadosAPi().execute();

    }

    public void refresh(View view) {

        new ObterDadosAPi().execute();
    }


    private class ObterDadosAPi extends AsyncTask<Void, Void, Void>{

        Filme[] lstFilmes;

        ProgressDialog progressDialog;

        @Override
        protected void onPreExecute() {
            super.onPreExecute();

            progressDialog = ProgressDialog.show(
                    MainActivity.context,
                    "Carregando",
                    "Aguarde", true);
        }

        @Override
        protected Void doInBackground(Void... params) {
            String server =  MainActivity.context.getString(R.string.endServidor);

           String json = Http.get(server + "/api.php");

            Log.d("ObterDadosAPi",json);

            Gson gson = new Gson();
            lstFilmes = gson.fromJson(json, Filme[].class);

            for(Filme f : lstFilmes)
                Log.d("ObterDadosAPi",f.getNome()+"\n");


            return null;
        }


        @Override
        protected void onPostExecute(Void aVoid) {
            super.onPostExecute(aVoid);

            //adapter.clear();//limpar o adapter
            //adapter.addAll(lstFilmes); // preenche-lo com dados novos

            progressDialog.dismiss();

            FilmesAdapter adapter = new
                    FilmesAdapter(
                    MainActivity.context,
                    R.layout.list_view_item,
                    lstFilmes);

            list_view.setAdapter(adapter);
        }
    }
}

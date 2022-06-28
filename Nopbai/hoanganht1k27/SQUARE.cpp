#include<bits/stdc++.h>
#define ii pair<int,int>
#define pi pair<ii,int>
#define X first
#define Y second
using namespace std;
const int N=2004;
int n,K,p,q,sum[N][N];
vector<pi> row,col;
struct hm
{
    int x,y,u,v;
};
hm a[N];
void build()
{
    if(col[0].Y==1){
        a[col[0].X.Y].y=1;
    }
    else a[col[0].X.Y].v=1;
    int dem=1;
    for(int i=1;i<col.size();i++)
    {
        if(col[i].X.X!=col[i-1].X.X) dem++;
        if(col[i].Y==1)
        {
            a[col[i].X.Y].y=dem;
        }
        else a[col[i].X.Y].v=dem;
        q=dem;
    }
    if(row[0].Y==1) a[row[0].X.Y].x=1;
    else a[row[0].X.Y].u=1;
    dem=1;
    for(int i=1;i<row.size();i++)
    {
        if(row[i].X.X!=row[i-1].X.X) dem++;
        if(row[i].Y==1) a[row[i].X.Y].x=dem;
        else a[row[i].X.Y].u=dem;
        p=dem;
    }
}
int cal(int x,int y,int u,int v)
{
    return sum[u][v]-sum[x-1][v]-sum[u][y-1]+sum[x-1][y-1];
}
void process()
{
    for(int i=1;i<=n;i++)
    {
        int x=a[i].x,y=a[i].y,u=a[i].u,v=a[i].v;
        //cout<<x<<" "<<y<<" "<<u<<" "<<v<<" "<<i<<endl;
        sum[x][y]++;
        sum[u+1][v+1]++;
        sum[u+1][y]--;
        sum[x][v+1]--;
    }
    for(int i=1;i<=p;i++)
    {
        for(int j=1;j<=q;j++)
        {
            sum[i][j]+=sum[i-1][j]+sum[i][j-1]-sum[i-1][j-1];
            //if(sum[i][j]>=1) sum[i][j]=1;
        }
    }
    for(int i=1;i<=p;i++)
    {
        for(int j=1;j<=q;j++)
        {
            int keep=sum[i][j];
            if(keep>=1) keep=1;
            sum[i][j]=sum[i-1][j]+sum[i][j-1]+keep-sum[i-1][j-1];
        }
    }
    for(int i=0;i<=p+1;i++)
    {
        for(int j=0;j<=q+1;j++)
        {
            if(i==0||i==p+1||j==0||j==q+1)
                sum[i][j]=0;
        }
    }
    cout<<cal(2,1,3,4);
}
int main()
{
    freopen("SQUARE.INP","r",stdin);
    freopen("SQUARE.OUT","w",stdout);
    cin>>n>>K;
    for(int i=1;i<=n;i++)
    {
        int x,y,u,v;
        cin>>y>>x>>v>>u;
        col.push_back(pi(ii(y,i),1));
        col.push_back(pi(ii(v,i),2));
        row.push_back(pi(ii(x,i),1));
        row.push_back(pi(ii(u,i),2));
        a[i]=(hm){x,y,u,v};
    }
    sort(col.begin(),col.end());
    sort(row.begin(),row.end());
    build();
    process();
}
